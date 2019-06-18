<?php

namespace App\Http\Controllers\Member;

use App\Models\Goods;
use App\Models\GoodsCategory;
use App\Models\Sides;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth,Validator;

class GoodsController extends BaseController
{
    public $banner;
    public function __construct()
    {
        parent::__construct();
        $this->banner = Sides::where('status', 1)->where('type', 3)->orderBy('sort', 'asc')->get();
    }

    public function index(Request $request)
    {
        $this->uc_here = '商品列表';
        $inputs = $request->only('status', 'search_title');
        //banner
        $banners = $this->banner;
        $goods_status = config('config_base.goods_status');
        $goods = Goods::where('user_id', Auth::guard()->user()->id);
//            ->whereIn('status', [-1, 0, 1]);
        if (!isset($inputs['status'])){
            $inputs['status'] = '1';
        }
        if ($inputs['status'] != 'all'){
            $goods = $goods->where('status', $inputs['status']);
        }
        if ($inputs['search_title']){
            $goods = $goods->where((function ($query) use($inputs) {
                $query->where('title', 'like', '%'.$inputs['search_title'].'%')->orWhere('long_title', 'like', '%'.$inputs['search_title'].'%');
            }));
        }
        $goods = $goods->orderBy('id', 'desc')->paginate(24);
        return $this->view('member.goods.index', compact('goods', 'banners', 'goods_status', 'inputs'));
    }

    public function create()
    {
        $this->uc_here = '添加商品';
        //banner
        $banners = $this->banner;
        //分类
        $categories = GoodsCategory::where('status', 1)->orderBy('lft')->get();
        return $this->view('member.goods.create', compact('categories', 'banners'));
    }
}