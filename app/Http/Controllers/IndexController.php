<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/28
 * Time: 16:53
 */

namespace App\Http\Controllers;


class IndexController extends Controller
{
    public function index()
    {
        return view('index.index');
    }
}