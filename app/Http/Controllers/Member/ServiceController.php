<?php
/**
 * -----------------------------------------
 * Desc:
 * User: Jiafang.Wang
 * Date: 2017/3/24
 * Time: 14:33
 * File: ServiceController.php
 * Project: DoctorVisit
 * -----------------------------------------
 */

namespace App\Http\Controllers\Member;


use App\Models\CompanyService;
use Illuminate\Support\Facades\Request;

class ServiceController extends BaseController
{
    /**
     * @name index
     * @desc
     * @author Jiafang.wange
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = CompanyService::get();
        return view('member.demand.index', ['data' => $data]);
    }

    /**
     * @name create
     * @desc
     * @author Jiafang.wange
     * @${date}
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('member.service.create');
    }

    /**
     * @name store
     * @desc
     * @author Jiafang.wange
     * @param Request $request
     */
    public function store(Request $request)
    {

    }
}