<?php
namespace App\Observers;

use App\Models\Sms;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;
use Mail;

class SmsObserver
{

    public function created(Sms $sms)
    {
        try{
            if ($sms->sms_type == 1){//手机

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
                throw new Exception('验证码类型错误');
            }
        }catch (\Exception $e){
            Log::error([
                'sms_id' => $sms->id,
                'sms_error' => $e->getMessage(),
            ]);
        }
    }
}