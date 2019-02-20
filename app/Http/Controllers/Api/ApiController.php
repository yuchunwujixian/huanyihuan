<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TipNews;

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
}
