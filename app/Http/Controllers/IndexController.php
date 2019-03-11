<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/28
 * Time: 16:53
 */

namespace App\Http\Controllers;

use App\Models\Sides;
use App\Models\Topic;
use DB;

class IndexController extends Controller
{
    public function index()
    {
        $this->title = '首页';
        //banner
        $banners = Sides::where('status', 1)->where('type', 0)->orderBy('sort', 'asc')->get();
        //专题 取5个，然后每个再取4个
        $topics = Topic::where('status', 1)->orderBy('sort', 'asc')->limit(5)->get();
        //所有数据都会返回，可以循环再取数据
        $topics->each(function (Topic $topic) {
            $topic->load(['goods' => function ($query) {
                $query->where('status', 1)->orderBy('view_count', 'desc')->limit(4);
            }]);
        });
        return $this->view('index.index', compact('banners', 'topics'));
    }
}