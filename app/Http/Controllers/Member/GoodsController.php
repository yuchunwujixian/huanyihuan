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
    public function index()
    {
        $this->uc_here = '商品列表';
        //banner
        $banners = Sides::where('status', 1)->where('type', 3)->orderBy('sort', 'asc')->get();
        $goods = Goods::where('user_id', Auth::guard()->user()->id)
            ->whereIn('status', [-1, 0, 1])
            ->paginate(24);
        return $this->view('member.goods.index', compact('goods', 'banners'));
    }

    public function create()
    {
        $this->uc_here = '添加商品';
        //banner
        $banners = Sides::where('status', 1)->where('type', 3)->orderBy('sort', 'asc')->get();
        //分类
        $categories = GoodsCategory::where('status', 1)->orderBy('lft')->get();
        return $this->view('member.goods.create', compact('categories', 'banners'));
    }
}