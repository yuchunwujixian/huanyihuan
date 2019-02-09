<?php
/**
 * --------------------------------------------
 * Desc：
 * User: Jiafang.Wang
 * Date: 2017/4/27 20:22
 * File: MemberBaseController.php
 * --------------------------------------------
 */


namespace App\Http\Controllers\Member;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Route;

class BaseController extends Controller
{
    public function __construct()
    {
        parent::__construct();

    }
}