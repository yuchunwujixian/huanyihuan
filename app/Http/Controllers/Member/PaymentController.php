<?php
/**
 * -----------------------------------------
 * Desc: 用户中心-充值-支付宝-微信
 * User: Jiafang.Wang
 * Date: 2017/3/24
 * Time: 14:07
 * File: PaymentController.php
 * Project: DoctorVisit
 * -----------------------------------------
 */

namespace App\Http\Controllers\Member;



class PaymentController extends BaseController
{
    public function index()
    {
        return view('member.payment.index');
    }

}