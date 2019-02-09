<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use Auth;
use Toastr;
use Illuminate\Support\Facades\Log;
use App\Models\PaymentLog;
use App\Models\User;

class AlipayController extends BaseController
{

// 发起支付请求
    public function Alipay(Request $request){
        $alipay = app('alipay.web');
        $alipay->setOutTradeNo($request->input('order_id'));
        $alipay->setTotalFee($request->input('account'));
        $alipay->setSubject('积分充值');
        $alipay->setBody('北京炯米互联有限公司支付宝支付');

        $alipay->setQrPayMode('5'); //该设置为可选1-5，添加该参数设置，支持二维码支付。

        // 跳转到支付页面。
        return redirect()->to($alipay->getPayLink());
    }

// 异步通知支付结果
    public function AliPayNotify(Request $request){
// 验证请求。
        if (!app('alipay.web')->verify()) {
            return 'fail';
        }
// 判断通知类型。
        switch ($request ->input('trade_status','')) {
            case 'TRADE_SUCCESS':
            case 'TRADE_FINISHED':
            $account = $request ->input('total_fee');
            $res = PaymentLog::where(['id' => $request ->input('out_trade_no'), 'account' => $account, 'user_id' => Auth::user()->id])->first();
            if ($res) {
                PaymentLog::where(['id' => $request ->input('out_trade_no'), 'account' => $account, 'user_id' => Auth::user()->id])->update(['status' => 1]);
                User::where('id', Auth::user()->id)->increment('integral', $account*10);
                return 'success';
            } else {
                return 'fail';
            }
                break;
        }
    }

     // 同步通知支付结果
    public function AliPayReturn(Request $request){
        // 验证请求。
        if (!app('alipay.web')->verify()) {
            Toastr::error('操作失败，请重新操作');
            return redirect()->route('member.integral.payment');
        }
        // 判断通知类型。
        switch ($request ->input('trade_status','')) {
            case 'TRADE_SUCCESS':
            case 'TRADE_FINISHED':
                $account = $request ->input('total_fee');
                $res = PaymentLog::where(['id' => $request ->input('out_trade_no'), 'account' => $account, 'user_id' => Auth::user()->id])->first();
                if ($res) {
                    PaymentLog::where(['id' => $request ->input('out_trade_no'), 'account' => $account, 'user_id' => Auth::user()->id])->update(['status' => 1]);
                    User::where('id', Auth::user()->id)->increment('integral', $account*10);
                    Toastr::success('充值成功');
                    return redirect()->route('member.integral.index');
                } else {
                    Toastr::error('订单修改失败，若您已扣钱，请联系商家');
                    return redirect()->route('member.integral.index');
                }
            break;
        }

    }

}
