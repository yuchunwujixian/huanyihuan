<?php
/**
 * 杂项
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Toastr;

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
        $about_us_info = AboutUs::select(['id','meta_keywords','meta_description','description','logo'])->first();
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
        $needs = $request->input('needs');
        $needs = explode(',', $needs);
        $rules = [];
        $date = array();
        $input = $request->all();
        foreach ($needs as $v){
            $rules[$v] = 'required';
            $date[$v] = $input[$v];
        }
        $this->validate($request, $rules);
        if ($request->hasFile('logo')){
            $date['logo'] = $request->file('logo')->store('aboutus');
        }
       if (!empty($input['id'])) {
           $date['id'] = intval($request->input('id'));
           $res = AboutUs::where('id', $date['id'])->update($date);
           $messge = "修该";
       } else {
           $aboutus=new AboutUs();
           $aboutus->fill($date);
           $res =  $aboutus->save();
           $messge = "添加";
       }
        if ($res) {
            Toastr::success($messge . '成功！');
        } else {
            Toastr::error($messge . '失败！');
        }
        return back();
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

    public function policy()
    {
        $this->title = '注册须知';
        $about_us_info = AboutUs::select(['id','policy'])->first();
        if (empty($about_us_info)){
            Toastr::error('请先编辑关于我们');
            return redirect()->route('admin.system.aboutus_index');
        }
        return $this->view('admin.system.policy', ['about_us_info' => $about_us_info]);
    }

}
