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
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function index()
    {
        $data = Feedback::get();
        return view('admin.feedback.index', ['data' => $data]);
    }
}