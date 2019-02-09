<?php
/**
 * -----------------------------------------
 * Desc:
 * User: Jiafang.Wang
 * Date: 2017/3/24
 * Time: 13:48
 * File: CompanyController.php
 * Project: DoctorVisit
 * -----------------------------------------
 */

namespace App\Http\Controllers;


use App\Models\Company;
use Illuminate\Http\Request;
use Validator;

class CompanyController extends Controller
{
    /**
     * @desc
     * @param $position
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author Jiafang.wang
     * @since 2017/5/13 20:00
     */
    public function index(Request $request)
    {
        $query = Company::where('status', 1);
        $position = $request->input('position');
        if($position) {
            $query = $query->where('position', 'LIKE', '%'.$position.'%');
        }
        $province_code = $request->input('province_code');
        if($province_code) {
            $query = $query->where('province_code', $province_code);
        }
        $lists = $query->paginate(10);
        return view('company.index', [
            'lists' => $lists,
            'position' => $position,
            'province_code' => $province_code,
            'province_config' => $this->province_config,
            'product_config' => $this->product_config,
        ]);
    }

    /**
     * @name show
     * @desc
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  ${date}
     * @update ${date}
     */
    public function show($id)
    {
        $data = Company::where('status', 1)->find($id);
        return view('company.show', [
            'data' => $data,
            'jobc' => $this->job_config,
            'province_config' => $this->province_config,
            'product_config' => $this->product_config,
        ]);
    }

    /**
     * @name lists
     * @desc 公司列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author jiafang.wang
     * @since  2017/3/30 17:02
     * @update 2017/3/30 17:02
     */
    public function lists(Request $request)
    {
        $data = Company::get();
        return view('company.lists', ['data' => $data]);
    }

    public function search(Request $request)
    {
        $messages = [
            'condition.required' => '筛选条件不能为空',
        ];

        $validator = Validator::make($request->all(), [
            'type_search' => 'required',
            'condition' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator);
        }

        $type = intval($request->input('type_search'));
        $condition = htmlspecialchars($request->input('condition'));
        if ($type == 1) {
            $data = Company::where('title', 'LIKE', '%'.$condition.'%')->get()->toArray();
            return view('search.search');
        }
        return view('search.search');
    }

}