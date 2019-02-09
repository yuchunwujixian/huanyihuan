<?php
/**
 * -----------------------------------------
 * Desc: 公司控制器
 * User: Jiafang.Wang
 * Date: 2017/3/21
 * Time: 17:08
 * File: CompanyController.php
 * Project: DoctorVisit
 * -----------------------------------------
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyModifyApplication;
use Illuminate\Http\Request;
use App\Service\AddressService;
use App\Models\CompanyPerson;
use GuzzleHttp\Client;

class CompanyController extends Controller
{
    /**
     * @desc 列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author Jiafang.wang
     * @since 2017/5/11 10:05
     */
    public function index()
    {
        $data = Company::get();
        return view('admin.company.index', [
            'data' => $data,
            'job_config' => $this->job_config,
            'province_config' => $this->province_config,
            'city_config' => $this->city_config,
            'area_config' => $this->area_config
        ]);
    }

    /**
     * @desc 更新-页面
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author Jiafang.wang
     * @since 2017/5/11 10:05
     */
    public function update($id)
    {
        $data = Company::find($id);
        $provinces = AddressService::getProvince(); // 获取省份信息

        return view('admin.company.edit', [
            'data' => $data,
            'job_config' => $this->job_config,
            'provinces' => $provinces,
            'company_type' => explode(',', $data->position),
        ]);
    }

    /**
     * @desc 保存
     * @param Request $request
     * @return $this
     * @author Jiafang.wang
     * @since 2017/5/11 10:05
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'province_name' => 'required',
            'city_name' => 'required',
            'area_name' => 'required',
            'address' => 'required',
            'url' => 'required',
            'resume_receive_email' => 'required',
        ]);

        $province = explode('|', $request->input('province_name'));
        $store_data = [
            'title' => $request->input('title'),
            'province_name' => $province[0],
            'province_code' => $province[1],
            'address' => $request->input('address'),
            'url' => $request->input('url'),
            'contact' => $request->input('contact'),
            'telephone' => $request->input('telephone'),
            'position' => implode(',', $request->input('company_type')),    //公司类型字符串存
            'resume_receive_email' => $request->input('resume_receive_email'),
            'status' => $request->input('status'),
        ];
        if(strpos($request->input('city_name'), '|')) {
            $city = explode('|', $request->input('city_name'));
            $store_data = array_merge($store_data, [
                'city_name' => $city[0],
                'city_code' => $city[1],
            ]);
        }
        if(strpos($request->input('area_name'), '|')) {
            $area = explode('|', $request->input('area_name'));
            $store_data = array_merge($store_data, [
                'area_name' => $area[0],
                'area_code' => $area[1],
            ]);
        }
        if($request->has('id')) {
            $store_data['reason'] = $request->input('reason');
            $store_data['view_status'] = 1;
            $affect_rows = Company::where('id', $request->input('id'))->update($store_data);
            $app = CompanyModifyApplication::where('company_id', $request->input('id'))->first();
            if ($app) {
                CompanyModifyApplication::where('company_id', $request->input('id'))->update(['status' => 1]);
            }
            if($affect_rows) {
                return redirect()->back()->withSuccess('更新成功');
            } else {
                return redirect()->back()->withErrors('操作异常');
            }
        } else {
            Company::create($store_data);
        }

    }

    /**
     * @desc 联系人
     * @param $company_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author Jiafang.wang
     * @since 2017/5/11 10:05
     */
    public function persons($company_id)
    {
        $lists = Company::find($company_id)->CompanyPersonInfo;
        return view('admin.company.contacts', ['lists' => $lists]);
    }

    /**
     * @desc 申请修改公司信息列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author Jiafang.wang
     * @since 2017/5/11 10:21
     */
    public function applyModifyInfo()
    {
        $lists = CompanyModifyApplication::orderBy('status', 'asc')->get();
        return view('admin.company.apply_modify_info_lists', ['lists' => $lists]);
    }

    /**
     * @desc
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author Jiafang.wang
     * @since 2017/5/31 19:51
     */
    public function tianyancha($id)
    {
        $company = Company::find($id);
        $client = new Client();
        $url = 'http://api.tianyancha.com/services/v3/open/edt?companyName=';
        $params = urlencode($company->title);
        $res = $client->request('GET', $url.$params);
        $data = json_decode($res->getBody(), true);
        return view('admin.company.tianyancha', [
            'data' => $data['result'],
            'company' => $company
        ]);
    }
}