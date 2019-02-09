<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IssueDemand;

class IssueDemandController extends Controller
{
    public $platform_array;
    public $game_type_array;
    /**
     * @name index
     * @desc  前台产品列表
     * @param Request $request
     * @param int $period
     * @param int $platform
     * @param int $type
     * @param int $game_type
     * @param int $cooperation
     * @param int $area
     * @param int $province
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/05/11
     * @update 2017/05/11
     */
    public function index(Request $request, $platform = 0, $type = 0, $game_type = 0, $cooperation = 0, $area = 0, $province = 0)
    {
        $data = IssueDemand::orderBy('updated_at', 'desc')->where(['status' => 1]);
        if ($platform) {
            $platform_string = substr($platform, 0, strlen($platform) - 2);
            $platform_str = substr($platform, -1, strlen($platform) - 1);
            $platform_array = explode(',', $platform_string);
            if (in_array($platform_str, $platform_array)) {
                $key = array_search($platform_str, $platform_array);
                array_splice($platform_array, $key, 1);
                if (count($platform_array) == 1) {
                    $platform = 0;
                } else {
                    $this->platform_array = array_unique($platform_array);
                    $data = $data->where(function ($query) {
                        foreach ($this->platform_array as $key => $v) {
                            $query = $query->orWhere('platform_id', 'like', "%$v%");
                        }
                    });
                    $platform = implode(',', $this->platform_array);
                }
            } else {
                $this->platform_array = array_unique(explode(',', $platform));
                $data = $data->where(function ($query) {
                    foreach ($this->platform_array as $key => $v) {
                        $query = $query->orWhere('platform_id', 'like', "%$v%");
                    }
                });
                $platform = implode(',', $this->platform_array);
            }
        }
        if ($type) {
            $type_string = substr($type, 0, strlen($type) - 2);
            $type_str = substr($type, -1, strlen($type) - 1);
            $typ_array = explode(',', $type_string);
            if (in_array($type_str, $typ_array)) {
                $key = array_search($type_str, $typ_array);
                array_splice($typ_array, $key, 1);
                if (count($typ_array) == 1) {
                    $type = 0;
                } else {
                    $data = $data->whereIn('type_id', $typ_array);
                    $type = implode(',', $typ_array);
                }
            } else {
                $type_array = array_unique(explode(',', $type));
                $data = $data->whereIn('type_id', $type_array);
                $type = implode(',', $type_array);
            }
        }
        if ($game_type) {
            $data = $data->where('game_type_id', $game_type);
        }
        if ($cooperation) {
            $data = $data->where('cooperation_id', 'like', "%$cooperation%");
        }
        if ($area) {
            $data = $data->where('area_id', $area);
        }
        if ($province) {
            $data = $data->where('province_code', $province);
        }
        $data = $data->paginate(10);
        return view('issue_demand.index', [
            'data' => $data,
            'product_config' => $this->product_config,
            'province_config' => $this->province_config,
            'game_type' => $game_type,
            'platform' => $platform,
            'type' => $type,
            'cooperation' => $cooperation,
            'area' => $area,
            'province' => $province,
        ]);
    }
}
