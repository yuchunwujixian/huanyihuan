<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Sms;
use App\Models\User;
use Illuminate\Http\Request;
use Toastr,DB;

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
    //短信
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
    //反馈
    public function feedback(Request $request)
    {
        $this->title = '用户反馈列表';
        $input = $request->only(['status']);
        $datas = Feedback::query();
        if ($input['status'] || $input['status'] === 0 || $input['status'] === '0'){
            $datas = $datas->where('status', $input['status']);
        }
        $datas = $datas->orderBy('status', 'asc')->orderBy('created_at', 'asc')->paginate(30);
        return $this->view('admin.member.feedback', compact('datas', 'input'));
    }

    public function feedbackStatus(Request $request)
    {
        $id = $request->input('id');
        DB::beginTransaction();
        try{
            $ids = explode(',', $id);
            if (empty($ids)){
                throw new \Exception('反馈id不能为空');
            }
            foreach ($ids as $k => $v){
                $res = Feedback::where('id', $v)->update(['status' => 1]);
                if (!$res) {
                    throw new \Exception('修改失败，反馈id:'.$v);
                }
            }
            DB::commit();
            $oupput = [
                'status' => 1,
                'message' => '修改成功！',
            ];
            return $this->tojson($oupput);
        }catch (\Exception $e){
            DB::rollBack();
            $oupput = [
                'status' => 0,
                'message' => $e->getMessage(),
            ];
            return $this->tojson($oupput);
        }

    }
}