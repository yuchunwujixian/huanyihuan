<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Email;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class EmailCodeController extends Controller
{

    public  function send(Request $request)
    {
        $email = $request->input('email');
        $code = rand(100000, 999999);
        //判断账号是否已注册
        $user = User::where('email', $email)->first();
        if ($user) {
            $date['code'] = 1;
            $date['message'] = "该账号已经注册，请换个账号";
            return $date;
        }

        //判断账号是否过期
        $res = Email::where(['email' => $email, 'type' => 1])->orderBy('created_at', 'desc')->get();
        if ($res->count()) {
            if (time() - strtotime($res[0]['created_at']) <= 300) {
                $date['code'] = 1;
                $date['message'] = "验证码已发送，无需重发";
                return $date;
            }
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
