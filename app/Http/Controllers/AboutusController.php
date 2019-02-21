<?php
/**
 * -----------------------------------------
 * Desc: 关于我们
 * User: Jiafang.Wang
 * Date: 2017/3/28
 * Time: 23:26
 * File: AboutusController.php
 * Project: www
 * -----------------------------------------
 */


namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use App\Models\Feedback;
use Toastr;
use Illuminate\Support\Facades\DB;

class AboutusController extends Controller
{
    /*
     * 关于我们
     */
    public function index()
    {
        $aboutus = AboutUs::first();
        $games = DB::table('games')->where('status', 1)->get();
        //提供服务-切为数组
        if (isset($aboutus->service)) {
            $services = explode("\n",$aboutus->service);
            foreach($services as $k=>$v){   //兼容unix
                $out_services[$k] = trim($v);
            }
        } else {
            $out_services = '';
        }
        return view('aboutus.index', [
            'aboutus' => $aboutus,
            'service' => $out_services,
            'games' => $games
        ]);
    }


    public function feedback(Request $request)
    {
        $this->validate($request, [
            'suggestInfo' => 'required',
        ]);

        $feedback = new Feedback();
        $feedback->content = htmlspecialchars($request->input('suggestInfo'));
        $res =  $feedback->save();
        if ($res) {
            Toastr::success('操作成功');
            return redirect()->back();
        } else {
            Toastr::error('操作失败');
            return redirect()->back();
        }
    }
}