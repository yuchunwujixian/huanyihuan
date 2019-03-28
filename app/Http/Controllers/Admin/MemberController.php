<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $this->title = '会员列表';
        $users = User::orderBy('id', 'desc')->paginate(30);
        return $this->view('admin.member.index', [
            'users' => $users,
        ]);
    }

    public function show($id)
    {
        $data = User::find($id);
        return view('admin.member.update', [
            'data' => $data,
        ]);
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

    public function edit()
    {

    }

    public function store()
    {

    }

}