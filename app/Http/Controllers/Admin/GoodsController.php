<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Goods;

class GoodsController extends Controller
{
    private $goods_status;

    public function __construct()
    {
        parent::__construct();
        $this->goods_status = config('config_base.goods_status');
    }

    /**
     * @name index
     * @desc  列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/03/18
     * @update 2017/03/18
     */
    public function index(Request $request)
    {
        $status = $request->input('status', 0);
        $search = $request->input('search_title');
        if ($status == 0){
            $this->title = '待审核商品列表';
        }elseif ($status == 1){
            $this->title = '已审核商品列表';
        }elseif ($status == 2){
            $this->title = '已完成商品列表';
        }elseif ($status == -2){
            $this->title = '已删除商品列表';
        }elseif ($status == -1){
            $this->title = '被禁止商品列表';
        }
        $lists = Goods::withTrashed()->where('status', $status);
        if ($search){
            $lists = $lists->where('title', 'like', '%'.$search.'%')->orWhere('long_title', 'like', '%'.$search.'%');
        }
        $lists = $lists->orderBy('id', 'asc')->paginate(30);
        $goods_status = $this->goods_status;
        return $this->view('admin.goods.index', compact('lists', 'goods_status'));
    }


    /**
     * @name view
     * @desc  查看
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/03/18
     * @update 2017/03/18
     */
    public function update($id)
    {
        $this->title = '查看商品详情';
        $data = Goods::withTrashed()->find($id);
        if (empty($data)){
            return redirect()->route('admin.goods.index')->withErrors('参数错误');
        }
        $goods_status = $this->goods_status;
        return $this->view('admin.goods.update', compact('data', 'goods_status'));
    }

    /**
     * @name save
     * @desc 修改或添加
     * @param Request $request
     * @return $this
     * @since  2017/03/18
     * @update 2017/03/18
     */
    public function save(Request $request)
    {
        $date['status'] = $request->input('status');
        $date['deleted_at'] = null;
        $id = $request->input('id');
        $info = Goods::withTrashed()->find($id);
        if (empty($info)){
            return redirect()->route('admin.goods.update', ['id' => $id])->withErrors('参数错误');
        }
        //删除特殊处理
        if ($date['status'] == -2){
            $date['deleted_at'] = date('Y-m-d H:i:s');
        }
        $res = Goods::withTrashed()->where('id', $id)->update($date);
        if ($res) {
            return redirect()->route('admin.goods.index')->withSuccess('修改成功！');
        } else {
            return redirect()->route('admin.goods.index')->withErrors('修改失败！');
        }

    }


}
