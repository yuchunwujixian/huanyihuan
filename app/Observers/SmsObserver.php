<?php
namespace App\Observers;

use App\Models\Sms;
use Illuminate\Support\Facades\Log;
use Mail;
use Flc\Alidayu\Client;
use Flc\Alidayu\App;
use Flc\Alidayu\Requests\AlibabaAliqinFcSmsNumSend;
use Flc\Alidayu\Requests\IRequest;

class SmsObserver
{

    public function created(Sms $sms)
    {
        try{
            if ($sms->sms_type == 1){//手机
                $config = config('laravel-sms')[$sms->type];
                $client = new Client(new App($config));
                $req    = new AlibabaAliqinFcSmsNumSend();

                $req->setRecNum($sms->username)
                    ->setSmsFreeSignName($config['sign_name'])
                    ->setSmsTemplateCode($config['template_code']);

                $resp = $client->execute($req);

//                Client::configure($config);  // 全局定义配置（定义一次即可，无需重复定义）
//                $resp = Client::request('alibaba.aliqin.fc.sms.num.send', function (IRequest $req)use($sms,$config) {
//                    $req->setRecNum($sms->username)
////                        ->setSmsParam([
////                            'code' => $sms->code
////                        ])
//                        ->setSmsFreeSignName($config['sign_name'])
//                        ->setSmsTemplateCode($config['template_code']);
//                });
                Log::info(print_r($resp, 1));
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