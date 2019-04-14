<?php

namespace App\Http\Controllers\Member;

use App\Models\Sides;
use App\Models\Sms;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth,Validator;

class GoodsController extends BaseController
{
    public function index()
    {
        $this->uc_here = '商品列表';
        $userInfo = Auth::guard()->user();
        //banner
        $banners = Sides::where('status', 1)->where('type', 2)->orderBy('sort', 'asc')->get();
        return $this->view('member.goods.index', compact('userInfo', 'banners'));
    }

    //保存个人资料
    public function store(Request $request)
    {
        $output = ['status' => 0, 'message' => '系统繁忙，请重试'];
        $input = $request->only(['avatar','nickname','name','description']);
        $rules = [
            'nickname' => 'required|max:12',
            'name' => 'required|max:4',
            'description' => 'max:255',
        ];
        $messages = [
            'nickname.required' => '昵称不能为空',
            'nickname.max' => '昵称不能超过12个字符',
            'name.required' => '真实姓名不能为空',
            'name.max' => '真实姓名不能超过4个字符',
            'description.max' => '个人说明不能超过4个字符',
        ];
        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()){
            $output['message'] = $validator->errors()->all()[0];
            return $this->tojson($output);
        }
        //头像处理
        $old_avatar = '';
        if ($input['avatar']){
            if ($request->user()->avatar && $input['avatar'] != $request->user()->avatar){
                $old_avatar = $request->user()->avatar;
            }
        }else{
            unset($input['avatar']);
        }
        $res = User::where('id', $request->user()->id)->update($input);
        if ($res) {
            if ($old_avatar){
                //可以清除旧的
//                Storage::delete($old_avatar);
            }
            $output['status'] = 1;
            $output['message'] = '操作成功';
        }
        return $this->tojson($output);
    }
    //绑定账号
    public function bandusername(Request $request)
    {
        $output = ['status' => 0, 'message' => ''];
        $username = $request->input('username');
        $code = $request->input('code');
        if (!$username || !$code){
            $output['message'] = "账号或验证码不能为空，请重试";
            return $this->tojson($output);
        }
        //判断账号是否已注册
        $input = [];
        $sms_type = 1;
        if (preg_match(config('config_base.mobile_rule'), $username)) {
            $input['mobile'] = $username;
        } elseif (preg_match(config('config_base.email_rule'), $username)) {
            $input['email'] = $username;
            $sms_type = 2;
        }
        if (!$input){
            $output['message'] = "账号格式不正确，请重试";
            return $this->tojson($output);
        }
        $user = User::where($input)->first();
        if ($user){
            $output['message'] = "该账号已经绑定，请切换其他账号";
            return $this->tojson($output);
        }

        //判断账号是否过期
        $res = Sms::where(['username' => $username, 'sms_type' => $sms_type, 'type' => 3, 'user_id' => auth()->user()->id])->orderBy('id', 'desc')->first();
        if ($res->count() > 0){
            if (time() - strtotime($res['created_at']) > 300) {
                $output['message'] = "验证码已失效，请重新发送";
                return $this->tojson($output);
            }
            if ($res['code'] !== $code) {
                $output['message'] = "验证码不正确，请重试";
                return $this->tojson($output);
            }
            //绑定账号
            $res = User::where('id', auth()->user()->id)->update($input);
            if ($res) {
                $output['status'] = 1;
                $output['message'] = "绑定成功";
                return $this->tojson($output);
            }else{
                $output['message'] = "系统繁忙，请重试";
                return $this->tojson($output);
            }
        }else{
            $output['message'] = "验证码不存在，请重试";
            return $this->tojson($output);
        }
    }
}