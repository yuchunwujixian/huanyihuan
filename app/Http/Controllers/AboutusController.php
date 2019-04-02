<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Sides;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Feedback;
use Toastr,Auth,Validator;
use Illuminate\Support\Facades\Log;

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
        $base_config = AboutUs::select(['meta_keywords', 'meta_description','description'])->first();
        return $this->view('aboutus.index', compact('banners', 'base_config'));
    }


    public function feedback(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|max:500',
        ]);
        if ($validator->fails()) {
            Toastr::error($validator->errors()->first('content'));
            return redirect()->back()->withInput();
        }
        $content = htmlspecialchars($request->input('content'));
        $user = Auth::user();
        $feedback = new Feedback();
        $fails = ['content' => $content];
        $feedback->content = $content;
        $feedback->created_at = date('Y-m-d H:i:s');
        $feedback->status = 0;
        if ($user){
            $feedback->user_id = $user->id;
            //赠送积分
            User::giveIntegral($user->id, 3, 5, '意见反馈送');
            $fails['user_id'] = $user->id;
        }
        $res =  $feedback->save();
        if (!$res) {
            Log::useFiles(storage_path('logs/feedback.log'));
            Log::error($fails);
        }
        Toastr::success('感谢您的意见，我们会及时处理');
        return redirect()->back();
    }
}