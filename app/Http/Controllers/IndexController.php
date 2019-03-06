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
//        $topics = Topic::with(['goods' => function ($query) {
//            $query->where('status', 1);
//        }])->where('status', 1)->orderBy('sort', 'asc')->limit(5)->get();
        $topics = Topic::where('status', 1)->orderBy('sort', 'asc')->limit(5)->get();
        //所有数据都会返回，可以循环再取数据
        foreach ($topics as &$v){
            $sql = 'select `hyh_goods`.*, `hyh_topic_goods`.`topic_id` as `pivot_topic_id`, `hyh_topic_goods`.`goods_id` as `pivot_goods_id` '.
                'from `hyh_goods` inner join `hyh_topic_goods` on `hyh_goods`.`id` = `hyh_topic_goods`.`goods_id` where `hyh_topic_goods`.`topic_id` = '.$v->id
                .' and `status` = 1 and `hyh_goods`.`deleted_at` is null limit 4';
            $v->goods = DB::select($sql);
        }
        return $this->view('index.index', compact('banners', 'topics'));
    }
}