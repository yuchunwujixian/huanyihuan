<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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


}
