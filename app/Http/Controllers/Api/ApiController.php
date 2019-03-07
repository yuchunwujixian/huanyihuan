<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sides;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Models\TipNews;
use DB;

class ApiController extends Controller
{
    /**
     * 获取tipnews
     */
    public function getTipNews()
    {
        $output = ['status' => 0, 'message' => ''];
        $output['status'] = 1;
        $output['data'] = TipNews::where('status', 1)->orderBy('sort', 'asc')->get()->toArray();
        return $this->tojson($output);
    }

    /**
     * 获取幻灯片
     */
    public function getSides(Request $request)
    {
        $type = $request->input('type', 0);//类型 0 首页 1专题 取配置config('config_base.sides_type')
        $p_id = $request->input('p_id', 0);//所属专题分类
        $output = ['status' => 0, 'message' => ''];
        $query = Sides::where('status', 1)->where('type', $type);
        switch ($type){
            case 0://获取首页
                break;
            case 1://获取专题类型
                if (!$p_id){
                    $output['message'] = '参数错误';
                    return $this->tojson($output);
                }
                $query = $query->where('p_id', $p_id);
                break;
            //TODO::可继续添加
        }
        $query = $query->orderBy('sort', 'asc')->get();
        //图片处理
        if ($query){
            foreach ($query as &$v){
                $v->img_url = env('APP_URL').'/storage/'.$v->img_url;
            }
        }
        $output['status'] = 1;
        $output['data'] = $query;
        return $this->tojson($output);
    }

    /**
     * 获取首页专题及旗下商品,旗下幻灯片
     */
    public function getTopic()
    {
        $output = ['status' => 0, 'message' => ''];
        $output['status'] = 1;
        $topics = Topic::where('status', 1)->orderBy('sort', 'asc')->limit(5)->get();
        //所有数据都会返回，可以循环在取数据
        $topics->each(function ($topic) {
            $topic->load(['goods' => function ($query) {
                $query->where('status', 1)->limit(4);
            }]);
        });
        $output['data'] = $topics;
        return $this->tojson($output);
    }
}
