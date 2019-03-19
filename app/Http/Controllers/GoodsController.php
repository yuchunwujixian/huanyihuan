<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/28
 * Time: 16:53
 */

namespace App\Http\Controllers;

use App\Models\Goods;
use App\Models\Topic;
use App\Service\AddressService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class GoodsController extends Controller
{
    public function index(Request $request)
    {
        $this->title = '商品列表';
        //专题
        $topics = Topic::where('status', 1)->orderBy('sort', 'asc')->get();
        $provinces = json_decode(Redis::get('province_cache'), true);
        $prices = config('config_base.prices');
        $citys = [];
        $goods = Goods::where('status', 1);
        $input = $request->only(['province', 'city', 'price', 'topic']);
        //省
        if ($input['province']){
            $goods = $goods->where('province_code', $input['province']);
            $citys = json_decode(Redis::get('province_city'.$input['province']), true);
        }
        //市
        if ($citys && $input['city'] && isset($citys[$input['city']])){
            $goods = $goods->where('city_code', $input['city']);
        }
        //价格
        if ($input['price']){
            $price = explode('~', $input['price']);
            if (is_numeric($price[1])){
                $goods = $goods->whereBetween('price', $price);
            }else{
                $goods = $goods->where('price', '>=', $price[0]);
            }
        }
        //专题
        if ($input['topic']){
            $goods = $goods->whereHas('topics', function ($query) use($input){
                $query->where('status', 1)->where('id', $input['topic']);
            });
        }
        //分类

        $goods = $goods->orderBy('view_count', 'desc')->paginate(48);
        return $this->view('index.goods', compact(
            'topics',
                'provinces',
                'goods',
                'citys',
                'prices'));
    }
}