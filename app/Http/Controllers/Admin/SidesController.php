<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sides;
use Illuminate\Support\Facades\Storage;
use Toastr;

class SidesController extends Controller
{
    protected $sides_type;

    public function __construct()
    {
        parent::__construct();
        $this->sides_type = config('config_base.sides_type');
    }

    /**
     * @name index
     * @desc  列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/03/18
     * @update 2017/03/18
     */
    public function index()
    {
        $this->title = '幻灯片列表';
        $lists = Sides::orderBy('type', 'desc')->orderBy('sort', 'asc')->paginate(30);
        $sides_type = $this->sides_type;
        return $this->view('admin.sides.index', compact('lists', 'sides_type'));
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
                $date['img_url'] = $request->file('file')->store('sides/'.$date['type'], 'public');
                Storage::delete($old_img);
            }
            $res = Sides::where('id', $date['id'])->update($date);
            $messge = "修改";

        } else {
            $this->validate($request, [
                'file' => 'required|image',
            ]);
            $date['img_url'] = $request->file('file')->store('sides/'.$date['type'], 'public');
            $tip = new Sides();
            $res =  $tip->fill($date)->save();
            $messge = "添加";
        }
        if ($res) {
            Toastr::success($messge . '成功！');
        } else {
            Toastr::error($messge . '失败！');
        }
        return redirect()->route('admin.sides.index');
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
            Toastr::success('删除成功！');
        } else {
            Toastr::error('删除失败！');
        }
        return redirect()->route('admin.sides.index');
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
