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
        $date['id'] = $request->input('id');
        if ($request->hasFile('file')) {//修改图片
            $info = Sides::find($date['id']);
            $old_img = $info['img_url'];
            $date['img_url'] = $request->file('file')->store('sides/'.$date['type']);
            Storage::delete($old_img);
        }
        $res = Sides::where('id', $date['id'])->update($date);
        $messge = "修改";
        if ($res) {
            return redirect()->route('admin.sides.index')->withSuccess($messge . '成功！');
        } else {
            return redirect()->route('admin.sides.index')->withErrors($messge . '失败！');
        }

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
        $this->title = '修改商品状态';
        $data = Sides::find($id);
        if (empty($data)){
            return redirect()->route('admin.sides.index')->withErrors('参数错误');
        }
        $sides_type = $this->sides_type;
        $p_ids = Sides::getData($data->type);
        return $this->view('admin.sides.update', compact('data', 'sides_type', 'p_ids'));
    }

}
