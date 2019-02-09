<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Flc\Alidayu\Client;
use Flc\Alidayu\Requests\IRequest;
use App\Models\LaravelSms;
use App\Models\User;

class LaravelSmsController extends Controller
{
    protected $mobile;
    protected $config = [
                'app_key'    => '23902433',
                'app_secret' => '41eab112dcc92e6b34fed26e142b75f7',
                    // 'sandbox'    => true,  // 是否为沙箱环境，默认false
                ];//配置信息
    protected $code;//验证码

    public function send(Request $request)
    {
        $this->mobile = $request->input('mobile');

        //判断账号是否已注册
        $user = User::where('mobile', $this->mobile)->first();
        if ($user) {
            $date['code'] = 1;
            $date['message'] = "该账号已经注册，请换个账号";
            return $date;
        }

        //判断账号是否超过次数
        $res = LaravelSms::where('mobile', $this->mobile)->orderBy('created_at', 'desc')->get();
        if ($res->count()) {
            if (time() - strtotime($res[0]['created_at']) <= 300) {
                $date['code'] = 1;
                $date['message'] = "验证码已发送，请注意查收";
                return $date;
            }
            if ($res->count() >= 3) {
                $date['code'] = 1;
                $date['message'] = "对不起，您的账号已操作三次，请联系官方解绑";
                return $date;
            }
        }

        $this->code = rand(100000, 999999);
        Client::configure($this->config);  // 全局定义配置（定义一次即可，无需重复定义）

        $resp = Client::request('alibaba.aliqin.fc.sms.num.send', function (IRequest $req) {
            $req->setRecNum($this->mobile)
                ->setSmsParam([
                    'code' => $this->code,
                    'product' => '北京炯米互联有限公司'
                ])
                ->setSmsFreeSignName('注册验证')
                ->setSmsTemplateCode('SMS_69190814');
        });
        if ($resp->result->success == 1) {
            LaravelSms::create([
                'mobile' => $this->mobile,
                'code' => $this->code
            ]);
            $date['code'] = 0;
            $date['message'] = "验证码发送成功，请注意查收";
            return $date;
        } else {
            $date['code'] = 1;
            $date['message'] = "操作失败";
            return $date;
        }
    }
}
