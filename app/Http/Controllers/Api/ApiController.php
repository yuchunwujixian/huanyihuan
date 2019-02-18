<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TipNews;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * 获取tipnews
     */
    public function getTipNews()
    {
        $output = ['status' => 0, 'message' => ''];
        $output['data'] = TipNews::where('status', 1)->orderBy('sort', 'asc')->get()->toArray();
        $output['status'] = 1;
        return $output;
    }
}
