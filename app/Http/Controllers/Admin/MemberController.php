<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sms;
use App\Models\User;
use Illuminate\Http\Request;
use Toastr;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $this->title = '会员列表';
        $input = $request->only(['order', 'type', 'keyword', 'like']);
        $users = User::query();
        if ($input['type'] && $input['keyword']){
            if ($input['like']){
                $users = $users->where($input['type'], 'like', '%'.$input['keyword'].'%');
            }else{
                $users = $users->where($input['type'], $input['keyword']);
            }
        }
        //排序
        $order = ['id', 'desc'];
        if ($input['order']){
            $order = explode(' ', $input['order']);
        }
        $users = $users->orderBy($order[0], $order[1])->paginate(30);
        return $this->view('admin.member.index', compact('users', 'input'));
    }
    //修改用户状态
    public function changeStatus(Request $request)
    {
        $id = $request->input('id', 0);
        $output = ['status' => 0, 'message' => '操作失败'];
        $info = User::find($id);
        if (!$info->count()){
            $output['message'] = '用户不存在';
            return $this->tojson($output);
        }
        $status = 0;
        if ($info->status == 0){
            $status = 1;
        }
        $info->status = $status;
        $res = $info->save();
        if ($res){
            $output['status'] = 1;
            $output['message'] = '操作成功';
        }
        return $this->tojson($output);
    }

    public function edit($id)
    {
        $this->title = '查看会员';
        $user = User::find($id);
        if (empty($user)){
            Toastr::error("参数错误");
            return back();
        }
        return $this->view('admin.member.update', [
            'user' => $user,
        ]);

    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (empty($data['id'])){
            Toastr::error("参数错误");
            return back();
        }
        $user = User::find($data['id']);
        if (empty($user)){
            Toastr::error("参数错误");
            return back();
        }
        if ($data['password']){
            $data['password'] = bcrypt($data['password']);
        }
        $res = $user->update($data);
        if (!$res){
            Toastr::error("操作失败，请重试");
        }else{
            Toastr::success("操作成功");
        }
        return back();
    }
    public function sms(Request $request)
    {
        $this->title = '短信验证日志';
        $input = $request->only(['type', 'sms_type', 'status']);
        $sms = Sms::query();
        if ($input['sms_type']){
            $sms = $sms->where('sms_type', $input['sms_type']);
        }
        if ($input['type']){
            $sms = $sms->where('type', $input['type']);
        }
        if ($input['status'] || $input['status'] === 0 || $input['status'] === '0'){
            $sms = $sms->where('status', $input['status']);
        }
        $sms = $sms->orderBy('id', 'desc')->paginate(30);
        return $this->view('admin.member.sms', compact('sms', 'input'));
    }
}