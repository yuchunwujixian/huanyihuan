<?php
/**
 * 杂项
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AboutUs;

class SystemController extends Controller
{

    /**
     * @name index
     * @desc  查看内容
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/04/17
     * @update 2017/04/17
     */
    public function aboutUsIndex()
    {
        $this->title = '关于我们';
        $about_us_info = AboutUs::first();
        return $this->view('admin.system.aboutusindex', ['about_us_info' => $about_us_info]);
    }

    /**
     * @name store
     * @desc  修改或编辑关于我们
     * @param Request $request
     * @return $this
     * @since  2017/04/17
     * @update 2017/04/17
     */
    public function aboutUsStore(Request $request)
    {
        $this->validate($request, [
            'description' => 'required',
            'meta_keywords' => 'required',
            'meta_description' => 'required',
        ]);

        $date = array();
        $date['description'] = $request->input('description');
        $date['meta_keywords'] = $request->input('meta_keywords');
        $date['meta_description'] = $request->input('meta_description');
       if ($request->input('id')) {
           $date['id'] = intval($request->input('id'));
           $res = AboutUs::where('id', $date['id'])->update($date);
           $messge = "修该";
       } else {
           $aboutus=new AboutUs();
           $aboutus->description = $date['description'];
           $aboutus->meta_keywords = $date['meta_keywords'];
           $aboutus->meta_description = $date['meta_description'];
           $res =  $aboutus->save();
           $messge = "添加";
       }
        if ($res) {
            return redirect()->route('admin.system.aboutus_index')->withSuccess($messge . '成功！');
        } else {
            return redirect()->route('admin.system.aboutus_index')->withErrors($messge . '失败！');
        }

    }

    /**
     * 上传文件
     */
    public function upload(Request $request)
    {
        $path = $request->file('imgFile')->store($request->input('img_path'));
        $path = $request->getSchemeAndHttpHost().'/storage/'.$path;
        $output = array('error' => 0, 'url' => $path);
        return $this->tojson($output);
    }

}
