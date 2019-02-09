<?php
/**
 * -----------------------------------------
 * Desc: 用户中心-积分
 * User: Jiafang.Wang
 * Date: 2017/3/24
 * Time: 14:09
 * File: IntegralController.php
 * Project: DoctorVisit
 * -----------------------------------------
 */

namespace App\Http\Controllers\Member;

use App\Models\Integral;
use Illuminate\Http\Request;
use Auth;
use Toastr;
use App\Models\User;
use App\Models\PaymentLog;

class IntegralController extends BaseController
{
    protected $fields = [
        'user_id' => '',
        'receive_user_id' => 0,
        'company_id' => '',
        'needs' => '',
        'feedback' => '',
        'status' => '1',
        'handle' => '0',
    ];

    /**
     * @name index
     * @desc  个人积分信息
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/5/19 16:49
     * @update 2017/5/19 16:49
     */
    public function index()
    {
        $user = Auth::user();
        return view('member.integral.index', compact('user'));
    }

    /**
     * @name store
     * @desc  发布帮助
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @since  2017/5/19 16:53
     * @update 2017/5/19 16:53
     */
    public function store(Request $request)
    {
        if (Auth::user()->integral < 5) {
            Toastr::error('对不起，您的积分不足，无法寻求帮助');
            return redirect('/');
        }
        $this->validate($request, [
            'needs' => 'required',
        ]);
        $integral = new Integral();
        foreach (array_keys($this->fields) as $field) {
            $integral->$field = $request->input($field, $this->fields[$field]);
        }
        $integral->user_id = Auth::user()->id;
        $integral->company_id = Auth::user()->companyInfo->id;
        $res = $integral->save();
        if ($res) {
            User::where('id', Auth::user()->id)->decrement('integral', 5);
            Toastr::success('操作成功');
            return redirect('/');
        } else {
            Toastr::error('操作失败，请重新操作');
            return redirect('/');
        }
    }

    /**
     * @name lists
     * @desc  查看别人发布情况
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/5/19 16:54
     * @update 2017/5/19 16:54
     */
    public function lists()
    {
        $data = Integral::where('user_id', '!=', Auth::user()->id)
            ->where('status', '!=', 2)
            ->orderBy('status', 'desc')
            ->orderBy('handle', 'asc')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
        return view('member.integral.lists', ['data' => $data]);
    }

    /**
     * @name show
     * @desc  别人发布帮助查看
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/5/19 16:55
     * @update 2017/5/19 16:55
     */
    public function show($id)
    {
        $data = Integral::where('status', '!=', -1)->find($id);
        if ($data['evaluate']) {
            Integral::where('id', $id)->update(['view_feedback' => 1]);
        }
        return view('member.integral.show', ['data' => $data]);
    }

    /**
     * @name feedback
     * @desc   回答别人的帮助
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @since  2017/5/19 16:55
     * @update 2017/5/19 16:55
     */
    public function feedback(Request $request)
    {
        $this->validate($request, [
            'feedback' => 'required',
        ]);
        $update_array = array(
            'feedback' => $request->input('feedback'),
            'receive_user_id' => Auth::user()->id,
            'handle' => 1,
            'view_issue' => 0,
        );
        $res = Integral::where(['id' => $request->input('id')])->update($update_array);
        if ($res) {
            Toastr::success('操作成功');
            return redirect()->route('member.integral.lists');
        } else {
            Toastr::error('提交失败，请重新提交');
            return redirect()->back();
        }
    }

    /**
     * @name answer
     * @desc  自己回答的帮助
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/5/19 16:55
     * @update 2017/5/19 16:55
     */
    public function answer()
    {
        $data = Integral::where('receive_user_id', Auth::user()->id)
            ->orderBy('status', 'desc')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
        return view('member.integral.answer', ['data' => $data]);
    }

    /**
     * @name question
     * @desc  自己寻求的帮助
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/5/19 16:56
     * @update 2017/5/19 16:56
     */
    public function question()
    {
        $data = Integral::where('user_id', Auth::user()->id)
            ->orderBy('handle', 'desc')
            ->orderBy('status', 'desc')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
        return view('member.integral.question', ['data' => $data]);
    }

    /**
     * @name view
     * @desc 查看自己寻求的帮助
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/5/19 16:56
     * @update 2017/5/19 16:56
     */
    public function view($id)
    {
        $data = Integral::where('user_id', Auth::user()->id)->find($id);
        if ($data['feedback']) {
            Integral::where(['id' => $id, 'user_id' => Auth::user()->id])->update(['view_issue' => 1]);
        }
        return view('member.integral.view', ['data' => $data]);
    }

    /**
     * @name sure
     * @desc 确认或取消自己需求的帮助
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @since  2017/5/19 16:56
     * @update 2017/5/19 16:56
     */
    public function sure(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'act' => 'required',
        ]);
        if ($request->input('act') == "submit") {
            $update_array = array(
                'status' => 0,
                'view_feedback' => 0,
                'evaluate' => $request->input('evaluate'),
            );
            $res = Integral::where([
                'id' => $request->input('id'),
                'user_id' => Auth::user()->id,
                'status' => 1,
            ])->update($update_array);
            if ($res) {
                $info = Integral::find($request->input('id'));
                User::where('id', $info->receiveUserInfo->id)->increment('integral', 5);
                Toastr::success('操作成功');
                return redirect()->route('member.integral.question');
            } else {
                Toastr::error('操作失败，请重新操作');
                return redirect()->back();
            }
        } else {
            $update_array = array(
                'status' => -1,
            );
            $res = Integral::where([
                'id' => $request->input('id'),
                'user_id' => Auth::user()->id,
                'status' => 1
            ])->update($update_array);
            if ($res) {
                User::where('id', Auth::user()->id)->increment('integral', 5);
                Toastr::success('操作成功');
                return redirect()->route('member.integral.question');
            } else {
                Toastr::error('操作失败，请重新操作');
                return redirect()->back();
            }
        }
    }

    public function refuse(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'act' => 'required',
        ]);
        $update_array = array(
            'status' => 2,
            'view_feedback' => 0,
            'evaluate' => $request->input('evaluate'),
        );
        $res = Integral::where([
            'id' => $request->input('id'),
            'user_id' => Auth::user()->id,
            'status' => 1,
        ])->update($update_array);
        if ($res) {
            Toastr::success('操作成功');
            return redirect()->route('member.integral.question');
        } else {
            Toastr::error('操作失败，请重新操作');
            return redirect()->back();
        }
    }

    /**
     * @name payment
     * @desc  去充值
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/6/3 10:10
     * @update 2017/6/3 10:10
     */
    public function payment()
    {
        return view('member.integral.payment', ['payment' => config('payment')]);
    }

    /**
     * @name pay
     * @desc  选择充值方式
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @since  2017/6/3 10:10
     * @update 2017/6/3 10:10
     */
    public function pay(Request $request)
    {
        $this->validate($request, [
            'account' => 'required|Numeric',
            'payment' => 'required',
        ]);
        $update_data = [
            'user_id' => Auth::user()->id,
            'account' => intval($request->input('account')),
            'payment' => $request->input('payment'),
            'status' => 0
        ];
        $res =  PaymentLog::create($update_data);
        if ($res->id) {
            return redirect()->route('member.' . $request->input('payment'), [
                'account' => intval($request->input('account')),
                'order_id' => $res->id,
            ]);
        }else {
            Toastr::error('操作失败，请重新操作');
            return redirect()->back();
        }
    }


    public function logs()
    {
        $data = PaymentLog::where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->paginate(15);
        return view('member.integral.logs', ['data' => $data]);
    }
}
