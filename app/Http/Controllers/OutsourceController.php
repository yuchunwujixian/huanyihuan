<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Outsource;

class OutsourceController extends Controller
{
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
    public function index(Request $request, $outsource = 0, $precondition = 0)
    {
        $data = Outsource::orderBy('updated_at', 'desc')->where(['status' => 1]);
        if ($outsource) {
            $data = $data->where('outsource_id', $outsource);
        }
        if ($precondition) {
            $data = $data->where('precondition_id', $precondition);
        }
        $data = $data->paginate(10);
        return view('outsource.index', [
            'data' => $data,
            'product_config' => $this->product_config,
            'precondition' => $precondition,
            'outsource' => $outsource,
        ]);
    }
}
