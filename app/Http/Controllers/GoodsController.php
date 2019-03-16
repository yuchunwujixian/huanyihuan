<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/28
 * Time: 16:53
 */

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class GoodsController extends Controller
{
    public function index(Request $request)
    {
        $this->title = '商品列表';
        //专题，然后每个再取
        $topics = Topic::where('status', 1)->orderBy('sort', 'asc')->get();
        //所有数据都会返回，可以循环再取数据
        $topics->each(function (Topic $topic) {
            $topic->load(['goods' => function ($query) {
                $query->where('status', 1)->orderBy('view_count', 'desc')->limit(4);
            }]);
        });
        $provinces = json_decode(Redis::get('province_cache'), true);
        return $this->view('index.goods', compact('topics', 'provinces'));
    }
}