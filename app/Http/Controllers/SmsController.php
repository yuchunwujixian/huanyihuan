<?php

namespace App\Http\Controllers;

use App\Models\Sms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class SmsController extends Controller
{

    public  function send(Request $request)
    {
        $output = ['status' => 0, 'message' => ''];
        $type = $request->input('type');
        $username = $request->input('username');
        $code = rand(100000, 999999);
        //判断账号是否已注册
        $input = [];
        $sms_type = 1;
        if ($type == 'mobile'){
            $input['mobile'] = $username;
        }elseif ($type == 'email'){
            $input['email'] = $username;
        }
        if (!$input){
            $output['message'] = "账号格式不正确，请重试";
            return $this->tojson($output);
        }
        $user = User::where($input)->first();
        if ($user) {
            $output['message'] = "该账号已经注册，请切换其他账号";
            return $this->tojson($output);
        }

        //判断账号是否过期
        $res = Sms::where(['username' => $username, 'sms_type' => $sms_type, 'type' => 1])->orderBy('created_at', 'desc')->first();
        if (!empty($res) && time() - strtotime($res['created_at']) <= 300) {
            $output['message'] = "验证码已发送，且有效，无需重发";
            return $this->tojson($output);
        }

        Mail::send('email.verify', ['code' => $code], function ($message) use ($email) {
            $message->to($email)->subject('注册通知');
        });
        Email::create([
            'email' => $email,
            'code' => $code,
            'type' => 1
        ]);
        $date['code'] = 0;
        $date['message'] = "验证码发送成功，请注意查收";
        return $date;
    }


    public  function forgot(Request $request)
    {
        $email = $request->input('email');
        $code = rand(100000, 999999);
        //判断账号是否已注册
        $user = User::where('email', $email)->get();
        if (empty($user->count())) {
            $date['code'] = 1;
            $date['message'] = "该账号未注册";
            return $date;
        }

        //判断账号是否过期
        $res = Email::where(['email' => $email, 'type' => 3])->orderBy('created_at', 'desc')->get();
        if ($res->count()) {
            if (time() - strtotime($res[0]['created_at']) <= 300) {
                $date['code'] = 1;
                $date['message'] = "验证码已发送，无需重发";
                return $date;
            }
        }

        Mail::send('email.forgot', ['code' => $code], function ($message) use ($email) {
            $message->to($email)->subject('找回密码');
        });
        Email::create([
            'email' => $email,
            'code' => $code,
            'type' => 3
        ]);
        $date['code'] = 0;
        $date['message'] = "验证码发送成功，请注意查收";
        return $date;
    }

}
