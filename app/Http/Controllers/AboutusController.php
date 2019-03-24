<?php

namespace App\Http\Controllers;

use App\Models\Sides;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Feedback;
use Toastr,Auth;

class AboutusController extends Controller
{
    /*
     * 关于我们
     */
    public function index()
    {
        $this->title = '关于我们';
        //banner
        $banners = Sides::where('status', 1)->where('type', 2)->orderBy('sort', 'asc')->get();
        return $this->view('aboutus.index', compact('banners'));
    }


    public function feedback(Request $request)
    {
        $this->validate($request, [
            'content' => 'required',
        ]);

        $user = Auth::user();
        $feedback = new Feedback();
        $feedback->content = htmlspecialchars($request->input('content'));
        $feedback->created_at = date('Y-m-d H:i:s');
        if ($user){
            $feedback->user_id = $user->id;
            //赠送积分
            User::giveIntegral($user->id, 3, 5, '意见反馈送');
        }
        $res =  $feedback->save();
        if ($res) {
            Toastr::success('操作成功');
            return redirect()->back();
        } else {
            Toastr::error('操作失败');
            return redirect()->back();
        }
    }
}