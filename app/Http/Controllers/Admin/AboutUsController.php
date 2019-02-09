<?php
/**
 * 关于我们控制器
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AboutUs;

class AboutUsController extends Controller
{

    /**
     * @name index
     * @desc  查看内容
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/04/17
     * @update 2017/04/17
     */
    public function index()
    {
        $about_us_info = AboutUs::first();
        return view('admin.aboutus.index', ['about_us_info' => $about_us_info]);
    }

    /**
     * @name store
     * @desc  修改或编辑关于我们
     * @param Request $request
     * @return $this
     * @since  2017/04/17
     * @update 2017/04/17
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'description' => 'required',
            'service' => 'required',
        ]);

        $date = array();
        $date['description'] = htmlspecialchars($request->input('description'));
        $date['service'] = htmlspecialchars($request->input('service'));
       if ($request->input('id')) {
           $date['id'] = intval($request->input('id'));
           $res = AboutUs::where('id', $date['id'])->update($date);
           $messge = "修该";
       } else {
           $aboutus=new AboutUs();
           $aboutus->description = $date['description'];
           $aboutus->service = $date['service'];
           $res =  $aboutus->save();
           $messge = "添加";
       }
        if ($res) {
            return redirect()->route('admin.aboutus.index')->withSuccess($messge . '成功！');
        } else {
            return redirect()->route('admin.aboutus.index')->withErrors($messge . '失败！');
        }

    }


}
