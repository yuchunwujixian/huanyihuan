<?php
namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public $uc_here;
    public function __construct()
    {
        parent::__construct();
        $this->title = '个人中心';
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
        if ($this->uc_here){
            $data = array_merge(['uc_here' => $this->uc_here], $data);
        }
        return view($view, $data, $mergeData);
    }
}