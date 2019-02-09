<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChannelDemand;

class ChannelDemandController extends Controller
{
    public $platform_array;
    public $game_type_array;
    public $type_array;
    /**
     * @name index
     * @desc  前台产品列表
     * @param Request $request
     * @param int $period
     * @param int $platform
     * @param int $type
     * @param int $game_type
     * @param int $cooperation
     * @param int $channel
     * @param int $province
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/05/11
     * @update 2017/05/11
     */
    public function index(Request $request, $platform = 0, $type = 0, $game_type = 0, $cooperation = 0, $channel = 0, $province = 0)
    {
        $data = ChannelDemand::orderBy('updated_at', 'desc')->where(['status' => 1]);
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
                    $platform = implode(',',  $this->platform_array);
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
            $type_array = explode(',', $type_string);
            if (in_array($type_str, $type_array)) {
                $key = array_search($type_str, $type_array);
                array_splice($type_array, $key, 1);
                if (count($type_array) == 1) {
                    $type = 0;
                } else {
                    $this->type_array = array_unique($type_array);
                    $data = $data->where(function ($query) {
                        foreach ($this->type_array as $key => $v) {
                            $query = $query->orWhere('type_id', 'like', "%$v%");
                        }
                    });
                    $type = implode(',',  $this->type_array);
                }
            } else {
                $this->type_array = array_unique(explode(',', $type));
                $data = $data->where(function ($query) {
                    foreach ($this->type_array as $key => $v) {
                        $query = $query->orWhere('type_id', 'like', "%$v%");
                    }
                });
                $type = implode(',', $this->type_array);
            }
        }
        if ($game_type) {
            $game_type_string = substr($game_type, 0, strlen($game_type) - 2);
            $game_type_str = substr($game_type, -1, strlen($game_type) - 1);
            $game_type_array = explode(',', $game_type_string);
            if (in_array($game_type_str, $game_type_array)) {
                $key = array_search($game_type_str, $game_type_array);
                array_splice($game_type_array, $key, 1);
                if (count($game_type_array) == 1) {
                    $game_type = 0;
                } else {
                    $this->game_type_array = array_unique($game_type_array);
                    $data = $data->where(function ($query) {
                        foreach ($this->game_type_array as $key => $v) {
                            $query = $query->orWhere('game_type_id', 'like', "%$v%");
                        }
                    });
                    $game_type = implode(',',  $this->game_type_array);
                }
            } else {
                $this->game_type_array = array_unique(explode(',', $game_type));
                $data = $data->where(function ($query) {
                    foreach ($this->game_type_array as $key => $v) {
                        $query = $query->orWhere('game_type_id', 'like', "%$v%");
                    }
                });
                $game_type = implode(',', $this->game_type_array);
            }
        }
        if ($cooperation) {
            $data = $data->where('cooperation_id', $cooperation);
        }
        if ($channel) {
            $data = $data->where('channel_id', $channel);
        }
        if ($province) {
            $data = $data->where('province_code', $province);
        }
        $data = $data->paginate(10);
        return view('channel_demand.index', [
            'data' => $data,
            'product_config' => $this->product_config,
            'province_config' => $this->province_config,
            'game_type' => $game_type,
            'platform' => $platform,
            'type' => $type,
            'cooperation' => $cooperation,
            'channel' => $channel,
            'province' => $province,
        ]);
    }
}
