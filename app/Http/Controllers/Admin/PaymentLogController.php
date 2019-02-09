<?php
/**
 * -----------------------------------------
 * Desc: 反馈控制器
 * User: Jiafang.Wang
 * Date: 2017/3/21
 * Time: 18:31
 * File: FeedbackController.php
 * Project: DoctorVisit
 * -----------------------------------------
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentLog;

class PaymentLogController extends Controller
{
    public function index()
    {
        $data = PaymentLog::orderBy('updated_at', 'desc')->get();
        return view('admin.paymentLog.index', ['data' => $data]);
    }
}