<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/28
 * Time: 16:53
 */

namespace App\Http\Controllers;

use App\Models\Sides;

class IndexController extends Controller
{
    public function index()
    {
        $this->title = '首页';
        $banners = Sides::where('status', 1)->where('type', 0)->orderBy('sort', 'asc')->get();
        return $this->view('index.index', compact('banners'));
    }
}