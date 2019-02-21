<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Auth;
use Illuminate\Support\Facades\Redis;
use Route;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $title;

    protected $base_config;

    protected $province_config;

    protected $city_config;

    protected $area_config;

    protected $company_config;

    protected $product_config;

    public function __construct()
    {
        $this->base_config = AboutUs::first();
        $this->product_config = config('product');
        $this->province_config = json_decode(Redis::get('province_cache'), true);
        $this->city_config = json_decode(Redis::get('city_cache'), true);
        $this->area_config = json_decode(Redis::get('area_cache_part1'), true) + json_decode(Redis::get('area_cache_part2'), true);
        //取当前路由名
        $route = Route::currentRouteName();
        $current_controller_array = explode('.', $route);
        \View::share('current_controller_array', $current_controller_array);
        \View::share('base_config', $this->base_config);
    }

    /**
     * 返回json数据
     * @date: 2019/2/19/019 15:26
     * @author: 路人甲
     * @param array $data
     * @param int $status
     * @param array $headers
     * @param int $options
     * @return \Illuminate\Http\JsonResponse
     */
    public function tojson($data = [], $status = 200, array $headers = [], $options = 0)
    {
        return response()->json($data, $status, $headers, $options);
    }

    /**
     * 页面渲染
     * @date: 2019/2/20/020 8:51
     * @author: 路人甲
     * @param null $view
     * @param array $data
     * @param array $mergeData
     */
    public function view($view = null, $data = [], $mergeData = []){
        if ($this->title){
            $data = array_merge(['title' => $this->title], $data);
        }
        return view($view, $data, $mergeData);
    }
}
