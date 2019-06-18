<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GoodsCategory;
use App\Models\TopicGoods;
use Illuminate\Http\Request;
use App\Models\Goods;
use DB;

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
        $status = $request->input('status', 0);//状态
        $search = $request->input('search_title');//名称
        $category_id = $request->input('category_id');//分类
        $param = $request->all();//所有
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
        //商品名称
        if ($search){
            $lists = $lists->where((function ($query) use($search) {
                $query->where('title', 'like', '%'.$search.'%')->orWhere('long_title', 'like', '%'.$search.'%');
            }));;
        }
        //商品分类
        if ($category_id){
            $lists = $lists->where('category_id', $category_id);
        }
        $lists = $lists->orderBy('id', 'desc')->paginate(30);
        $goods_status = $this->goods_status;
        $categories = GoodsCategory::orderBy('lft')->get();
        return $this->view('admin.goods.index', compact('lists', 'goods_status', 'categories', 'param'));
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
        $is_batch = $request->input('is_batch', 0);//是否批量审核 1是
        $status = $request->input('status');
        $id = $request->input('id');
        DB::beginTransaction();
        try{
            $ids = [];
            if ($is_batch){
                $ids = explode(',', $id);
            }else{
                $ids = (array)$id;
            }
            if (empty($ids)){
                throw new \Exception('审核商品不能为空');
            }
            //删除特殊处理
            $date['deleted_at'] = null;
            $date['status'] = $status;
            if ($status == -2){
                $date['deleted_at'] = date('Y-m-d H:i:s');
            }
            //返回上一个页面的状态
            $back_status = 0;
            foreach ($ids as $k => $v){
                $info = Goods::withTrashed()->find($v);
                if (empty($info)){
                    throw new \Exception('参数错误，商品id:'.$v);
                }
                if ($k == 0){
                    $back_status = $info->status;
                }
                $res = Goods::withTrashed()->where('id', $v)->update($date);
                if (!$res) {
                    throw new \Exception('修改失败，商品id:'.$v);
                }
                //TODO::特殊处理--删除专题下商品
                TopicGoods::where('goods_id', $v)->delete();
            }
            DB::commit();
            if ($request->ajax()){
                $oupput = [
                    'status' => 1,
                    'message' => '修改成功！',
                ];
                return $this->tojson($oupput);
            }else{
                return redirect()->route('admin.goods.index', ['status' => $back_status])->withSuccess('修改成功！');
            }
        }catch (\Exception $e){
            DB::rollBack();
            if ($request->ajax()){
                $oupput = [
                    'status' => 0,
                    'message' => $e->getMessage(),
                ];
                return $this->tojson($oupput);
            }else{
                return redirect()->route('admin.goods.index', ['status' => $back_status])->withErrors($e->getMessage());
            }
        }

    }

    public function categoryIndex()
    {
        $this->title = '商品分类列表';
        $lists = GoodsCategory::orderBy('lft')->get();
        return $this->view('admin.goods.categoryindex', ['lists' => $lists]);
    }

    public function categoryCreate()
    {
        $this->title = '增加商品分类';
        $categories = GoodsCategory::orderBy('lft')->get();
        return $this->view('admin.goods.categorycreate', ['categories' => $categories]);
    }

    public function categorySave(Request $request)
    {
        $this->validate($request, [
            'parent_id' => 'required',
            'title' => 'required|min:2',
            'sort' => 'numeric',
        ]);
        $update_data = [
            'title' => $request->input('title'),
            'parent_id' => $request->input('parent_id'),
            'status' => $request->input('status'),
            'sort' => $request->input('sort'),
        ];
        if ($request->has('id')) {
            GoodsCategory::where('id', $request->input('id'))->update($update_data);
        } else {
            if ($request->input('parent_id') == 0) {
                GoodsCategory::create($update_data);
            } else {
                $root = GoodsCategory::find($request->input('parent_id'));
                $root->children()->create(['title' => $request->input('title')]);
            }

        }
        return redirect()->route('admin.category.index')->withSuccess('操作成功！');

    }

    public function categoryUpdate($id)
    {
        $this->title = '编辑商品分类';
        $category = GoodsCategory::find($id);
        $categories = GoodsCategory::orderBy('lft')->get();
        return $this->view('admin.goods.categoryupdate', ['category' => $category, 'categories' => $categories]);
    }

    public function categoryDel($id)
    {
        $category = GoodsCategory::find($id);
        if (!$category){
            return redirect()->route('admin.category.index')->withErrors( '该分类不存在');
        }
        $childs = $category->childs->toArray();
        if (!empty($childs)){
            return redirect()->route('admin.category.index')->withErrors( '该分类下有子分类');
        }
        $jobs = $category->goods->toArray();
        if(empty($jobs)) {
            $category->destroy($id);
            return redirect()->route('admin.category.index')->withSuccess( '操作成功');
        } else {
            return redirect()->route('admin.category.index')->withErrors( '该分类下存在商品');
        }
    }
}
