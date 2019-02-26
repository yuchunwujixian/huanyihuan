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
     * @name create
     * @desc  添加
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/03/18
     * @update 2017/03/18
     */
    public function create()
    {
        $this->title = '增加幻灯片';
        $sides_type = $this->sides_type;
        return $this->view('admin.sides.create', compact('sides_type'));
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
        $this->validate($request, [
            'title' => 'required|min:2',
        ]);
        $date['title'] = $request->input('title');
        $date['type'] = $request->input('type');
        $date['p_id'] = $request->input('p_id', 0);
        $date['url'] = $request->input('url');
        $date['sort'] = $request->input('sort');
        $date['status'] = $request->input('status');
        if ($request->has('id')) {
            $date['id'] = $request->input('id');
            if ($request->hasFile('file')) {//修改图片
                $info = Sides::find($date['id']);
                $old_img = $info['img_url'];
                $date['img_url'] = $request->file('file')->store('sides/'.$date['type']);
                Storage::delete($old_img);
            }
            $res = Sides::where('id', $date['id'])->update($date);
            $messge = "修改";

        } else {
            $this->validate($request, [
                'file' => 'required|image',
            ]);
            $date['img_url'] = $request->file('file')->store('sides/'.$date['type']);
            $tip = new Sides();
            $res =  $tip->fill($date)->save();
            $messge = "添加";
        }
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
        $this->title = '编辑幻灯片';
        $data = Sides::find($id);
        if (empty($data)){
            return redirect()->route('admin.sides.index')->withErrors('参数错误');
        }
        $sides_type = $this->sides_type;
        $p_ids = Sides::getData($data->type);
        return $this->view('admin.sides.update', compact('data', 'sides_type', 'p_ids'));
    }


    /**
     * @name del
     * @desc 删除
     * @param $id
     * @return $this
     * @since  2017/03/19
     * @update 2017/03/19
     */
    public function del($id)
    {
        $info = Sides::find($id);
        $old_img = $info['img_url'];
        Storage::delete($old_img);
        $res = $info->delete($id);
        if ($res) {
            return redirect()->route('admin.sides.index')->withSuccess( '删除成功！');
        } else {
            return redirect()->route('admin.sides.index')->withErrors( '删除失败！');
        }
    }

    /**
     * 或得分类下类型
     */
    public function getSidesType(Request $request)
    {
        $output = ['status' => 1, 'message' => '', 'data' => []];
        $type = $request->input('type', 0);
        $output['data'] = Sides::getData($type);
        return $this->tojson($output);
    }

}
