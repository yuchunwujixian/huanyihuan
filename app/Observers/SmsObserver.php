<?php
namespace App\Observers;

use App\Models\Sms;
use Illuminate\Support\Facades\Log;
use Mail;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;

class SmsObserver
{

    public function created(Sms $sms)
    {
        try{
            if ($sms->sms_type == 1){//手机
                $config = config('laravel-sms')[$sms->type];
                AlibabaCloud::accessKeyClient($config['app_key'], $config['app_secret'])
                    ->regionId('cn-hangzhou')
                    ->asGlobalClient();
                $query = [
                    'RegionId' => 'cn-hangzhou',
                    'PhoneNumbers' => $sms->username,
                    'SignName' => $config['sign_name'],
                    'TemplateCode' => $config['template_code'],
                ];
                if (!empty($config['template_param'])){
                    $query['TemplateParam'] = json_encode(['code' => $sms->code]);
                }
                $result = AlibabaCloud::rpcRequest()
                    ->product('Dysmsapi')
                    ->version('2017-05-25')
                    ->action('SendSms')
                    ->method('POST')
                    ->options([
                        'query' => $query,
                    ])
                    ->request();
                Log::info(print_r($result->toArray(),1));
            }elseif ($sms->sms_type == 2){//邮箱
                // emails.test 指向\resources\views\emails\test.blade.php
                switch ($sms->type){
                    case 1:
                        Mail::send('email.verify',['code'=>$sms->code],function($message)use($sms){
                            $message->to($sms->username)->subject('注册通知');
                        });
                        break;
                    case 2:
                        Mail::send('email.forgot',['code'=>$sms->code],function($message)use($sms){
                            $message->to($sms->username)->subject('重置密码');
                        });
                        break;

                }
                Sms::where('id', $sms->id)->update([
                    'status' => 1
                ]);
            }else{
                throw new \Exception('验证码类型错误');
            }
        }catch (\Exception $e){
            Log::error([
                'sms_id' => $sms->id,
                'sms_error' => $e->getMessage(),
            ]);
        }
    }
}