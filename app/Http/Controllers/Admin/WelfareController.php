<?php
/**
 * 福利控制器
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Welfare;

class WelfareController extends Controller
{
    protected $fields = [
        'title',
        'status'
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
        $lists = Welfare::get();
        return view('admin.welfare.index', ['lists' => $lists]);
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
        return view('admin.welfare.create');
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
        $date['status'] = $request->input('status');
        if ($request->has('id')) {
            $date['id'] = $request->input('id');
            $res = Welfare::where('id', $date['id'])->update($date);
            $messge = "修改";

        } else {
            $welfare=new Welfare();
            foreach (array_keys($this->fields) as $field) {
                $welfare->$field = $request->input($field, $this->fields[$field]);
            }
            $res =  $welfare->save();
            $messge = "添加";
        }
        if ($res) {
            return redirect()->route('admin.welfare.index')->withSuccess($messge . '成功！');
        } else {
            return redirect()->route('admin.welfare.index')->withErrors($messge . '失败！');
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
        $data = Welfare::find($id);
        return view('admin.welfare.update', ['data' => $data]);
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
        $res = Welfare::destroy($id);
        if ($res) {
            return redirect()->route('admin.welfare.index')->withSuccess( '删除成功！');
        } else {
            return redirect()->route('admin.welfare.index')->withErrors( '删除失败！');
        }
    }

}
