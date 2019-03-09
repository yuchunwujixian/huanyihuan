<?php
namespace App\Http\Controllers\Admin;

use App\Models\Goods;
use App\Models\GoodsCategory;
use App\Models\TopicGoods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Topic;

class TopicController extends Controller
{

    /**
     * @name index
     * @desc  列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/03/18
     * @update 2017/03/18
     */
    public function index()
    {
        $this->title = '专题列表';
        $lists = Topic::orderBy('sort', 'asc')->get();
        return $this->view('admin.topic.index', ['lists' => $lists]);
    }


    /**
     * @name create
     * @desc  添加福利
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/03/18
     * @update 2017/03/18
     */
    public function create()
    {
        $this->title = '增加专题';
        return $this->view('admin.topic.create');
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
        $date['sort'] = $request->input('sort');
        $date['status'] = $request->input('status');
        if ($request->has('id')) {
            $date['id'] = $request->input('id');
            $res = Topic::where('id', $date['id'])->update($date);
            $messge = "修改";

        } else {
            $tip = new Topic();
            $res =  $tip->fill($date)->save();
            $messge = "添加";
        }
        if ($res) {
            return redirect()->route('admin.topic.index')->withSuccess($messge . '成功！');
        } else {
            return redirect()->route('admin.topic.index')->withErrors($messge . '失败！');
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
        $this->title = '编辑专题';
        $data = Topic::find($id);
        return $this->view('admin.topic.update', ['data' => $data]);
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
        $res = Topic::destroy($id);
        if ($res) {
            //删除专题商品
            TopicGoods::where('topic_id', $id)->delete();
            return redirect()->route('admin.topic.index')->withSuccess( '删除成功！');
        } else {
            return redirect()->route('admin.topic.index')->withErrors( '删除失败！');
        }
    }

    /**
     * 专题下商品
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function goods(Request $request, $id)
    {
        $this->title = '专题下商品';
        //专题信息
        $data = Topic::with('goods')->find($id);
        if (empty($data)){
            return redirect()->route('admin.topic.index')->withErrors( '专题不存在！');
        }
        $has_goods = array_column($data->goods->toArray(), 'id');
        $search = $request->input('search_title');//名称
        $category_id = $request->input('category_id');//分类
        $param = $request->all();//所有
        $lists = Goods::where('status', 1);
        //商品名称
        if ($search){
            $lists = $lists->where('title', 'like', '%'.$search.'%')->orWhere('long_title', 'like', '%'.$search.'%');
        }
        //商品分类
        if ($category_id){
            $lists = $lists->where('category_id', $category_id);
        }
        $lists = $lists->orderBy('id', 'asc')->paginate(100);
        $goods_status = config('config_base.goods_status');
        $categories = GoodsCategory::where('status', 1)->orderBy('lft')->get();
        return $this->view('admin.topic.goods', compact('data','has_goods','lists', 'goods_status', 'categories', 'param'));
    }

    public function saveGoods(Request $request, $id)
    {
        //专题信息
        $data = Topic::with('goods')->find($id);
        if (empty($data)){
            return redirect()->route('admin.topic.index')->withErrors( '专题不存在！');
        }
        $goods_ids = $request->input('goods_ids');//名称
        $has_goods = array_column($data->goods->toArray(), 'id');
        if ($has_goods){
            $goods_ids = array_unique(array_merge($goods_ids, $has_goods));
        }
        $res = $data->goods()->sync($goods_ids);
        if ($res) {
            return redirect()->back()->withSuccess( '操作成功！');
        } else {
            return redirect()->back()->withErrors( '操作失败！');
        }
    }

    public function delGoods(Request $request, $id)
    {
        $goods_id = $request->input('goods_id');
        $goods_id = explode(',', $goods_id);
        $res = TopicGoods::where('topic_id', $id)->whereIn('goods_id', $goods_id)->delete();
        if ($res) {
            return redirect()->back()->withSuccess( '删除成功！');
        } else {
            return redirect()->back()->withErrors( '删除失败！');
        }
    }
}
