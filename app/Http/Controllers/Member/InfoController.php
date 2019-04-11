<?php

namespace App\Http\Controllers\Member;

use App\Models\Sides;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth,Validator;

class InfoController extends BaseController
{
    public function index()
    {
        $this->uc_here = '基本资料';
        $userInfo = Auth::guard()->user();
        //banner
        $banners = Sides::where('status', 1)->where('type', 2)->orderBy('sort', 'asc')->get();
        return $this->view('member.info.update', compact('userInfo', 'banners'));
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
}