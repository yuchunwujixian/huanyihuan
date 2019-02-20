<?php
namespace App\Http\Controllers\Admin;

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
        $res = TipNews::destroy($id);
        if ($res) {
            return redirect()->route('admin.tipnews.index')->withSuccess( '删除成功！');
        } else {
            return redirect()->route('admin.tipnews.index')->withErrors( '删除失败！');
        }
    }

}
