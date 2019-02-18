<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TipNews;

class TipNewsController extends Controller
{
    protected $fields = [
        'title',
        'url',
        'status',
        'sort',
    ];

    /**
     * @name index
     * @desc  福利列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/03/18
     * @update 2017/03/18
     */
    public function index()
    {
        $lists = TipNews::orderBy('sort', 'asc')->get();
        return view('admin.tipnews.index', ['lists' => $lists]);
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
        return view('admin.tipnews.create');
    }


    /**
     * @name save
     * @desc 修改或添加福利
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
        $date['url'] = $request->input('url');
        $date['sort'] = $request->input('sort');
        $date['status'] = $request->input('status');
        if ($request->has('id')) {
            $date['id'] = $request->input('id');
            $res = TipNews::where('id', $date['id'])->update($date);
            $messge = "修改";

        } else {
            $welfare = new TipNews();
            $res =  $welfare->fill($date)->save();
            $messge = "添加";
        }
        if ($res) {
            return redirect()->route('admin.tipnews.index')->withSuccess($messge . '成功！');
        } else {
            return redirect()->route('admin.tipnews.index')->withErrors($messge . '失败！');
        }

    }


    /**
     * @name view
     * @desc  查看福利
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/03/18
     * @update 2017/03/18
     */
    public function update($id)
    {
        $data = TipNews::find($id);
        return view('admin.tipnews.update', ['data' => $data]);
    }


    /**
     * @name del
     * @desc 删除福利
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
