<?php
namespace App\Http\Controllers\Admin;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sides;

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
        $lists = Sides::orderBy('type', 'desc')->orderBy('sort', 'asc')->get();
        return $this->view('admin.sides.index', ['lists' => $lists]);
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
            $res = Topic::where('id', $date['id'])->update($date);
            $messge = "修改";

        } else {
            $this->validate($request, [
                'file' => 'required|image',
            ]);
            $date['img_url'] = $request->file('file')->store('sides');
            dd($date['img_url']);
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
        $res = TipNews::destroy($id);
        if ($res) {
            return redirect()->route('admin.tipnews.index')->withSuccess( '删除成功！');
        } else {
            return redirect()->route('admin.tipnews.index')->withErrors( '删除失败！');
        }
    }

    /**
     * 或得分类下类型
     */
    public function getSidesType(Request $request)
    {
        $output = ['status' => 1, 'message' => '', 'data' => []];
        $type = $request->input('type', 0);
        switch ($type){
            case 1://获取专题类型
                $output['data'] = Topic::where('status', 1)->orderBy('sort', 'asc')->get(['id', 'title as name']);
                break;
            //TODO::可继续添加
        }
        return $this->tojson($output);
    }

}
