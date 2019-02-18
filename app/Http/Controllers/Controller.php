<?php

namespace App\Http\Controllers;

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

    protected $job_config;

    protected $province_config;

    protected $city_config;

    protected $area_config;

    protected $welfare_config;

    protected $company_config;

    protected $product_config;

    public function __construct()
    {
        $this->job_config = config('job');
        $this->product_config = config('product');
        $this->province_config = json_decode(Redis::get('province_cache'), true);
        $this->city_config = json_decode(Redis::get('city_cache'), true);
        $this->area_config = json_decode(Redis::get('area_cache_part1'), true) + json_decode(Redis::get('area_cache_part2'), true);
        //取当前路由名
        $route = Route::currentRouteName();
        $current_controller_array = explode('.', $route);
        \View::share('current_controller_array', $current_controller_array);
    }
}
