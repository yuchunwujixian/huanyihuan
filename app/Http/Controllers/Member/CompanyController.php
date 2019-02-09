<?php
/**
 * -----------------------------------------
 * Desc: 用户中心-公司相关控制器
 * User: Jiafang.Wang
 * Date: 2017/3/21
 * Time: 17:08
 * File: CompanyController.php
 * Project: JiongMiGame
 * -----------------------------------------
 */

namespace App\Http\Controllers\Member;

use App\Models\CompanyModifyApplication;
use App\Models\CompanyPerson;
use App\Models\CompanyPhoto;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Service\AddressService;
use Illuminate\Support\Facades\Auth;
use Toastr;

class CompanyController extends BaseController
{
    /**
     * @desc 首页
     * @since 2017/4/26 22:21
     * @author Jiafang.Wang
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $provinces = AddressService::getProvince(); // 获取省份信息
        $data = Auth::user()->companyInfo;  //公司信息
        if($data) {
            $persons = CompanyPerson::where('company_id', $data->id)->get();    //联系人
            $photos = CompanyPhoto::where('company_id', $data->id)->get();  //公司环境图片
            $apply_info = CompanyModifyApplication::where(['user_id' => Auth::user()->id, 'status' => 0])->orderBy('id', 'desc')->first();
            Company::where('id', $data->id)->update(['view_status' => 0]);
            return view('member.company.index', [
                'job_config' => $this->job_config,
                'provinces' => $provinces,
                'data' => $data,
                'persons' => $persons,
                'company_type' => explode(',', $data->position),
                'disabled_text' => $data->status ? ' disabled = "disabled" ' : '',
                'photos' => $photos,
                'apply_modify_info' => $apply_info,
            ]);
        } else {
            return view('member.company.index', [
                'data' => $data,
                'job_config' => $this->job_config,
                'provinces' => $provinces,
            ]);
        }
    }

    /**
     * @desc 保存公司基本资料
     * @param Request $request
     * @since 2017/4/26 22:21
     * @author Jiafang.Wang
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:companies',
            'company_address' => 'required',
            'province_name' => 'required',
            'company_url' => 'required',
            'description' => 'required',
            'company_email' => 'required|email',
            'contact' => 'required',
            'telephone' => 'required',
        ]);

        $province = explode('|', $request->input('province_name'));
        $store_data = [
            'user_id' => $request->user()->id,
            'title' => $request->input('title'),
            'province_name' => $province[0],
            'province_code' => $province[1],
            'url' => $request->input('company_url'),
            'logo' => $request->input('company_logo_url'),
            'contact' => $request->input('contact'),
            'telephone' => $request->input('telephone'),
            'position' => implode(',', $request->input('company_type')),    //公司类型字符串存
            'description' => $request->input('description'),
            'resume_receive_email' => $request->input('company_email'),
            'address' => $request->input('company_address'),
            'status' => 1,  //待后台审核
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
        if ($request->has('id')) {
            $company_id = $request->input('id');
            $affect_rows = Company::where('id', $company_id)->update($store_data);
            if($affect_rows) {
                Toastr::success('更新成功');
            } else {
                Toastr::error('操作失败');
            }
            return redirect()->back();
        } else {
            $company_id = Company::insertGetId($store_data);
            if($company_id) {
                User::where('id', $request->user()->id)->update(['company_id'=> $company_id]);
                if ($request->user()->mobile) {
                    $company_person_data = [
                        'user_id' => $request->user()->id,
                        'company_id' => $company_id,
                        'name' => $request->user()->name,
                        'manage_position' => $request->user()->position,
                        'manage_area' => $request->user()->manage_area,
                        'manage_matters' => $request->user()->manage_matters,
                        'telephone' => $request->user()->mobile,
                    ];
                    CompanyPerson::insert($company_person_data);
                }
                Toastr::success('更新成功');
            } else {
                Toastr::error('操作失败');
            }
            return redirect()->back();
        }
    }

    /**
     * @desc 保存公司联系人
     * @param Request $request
     * @since 2017/4/26 22:20
     * @author Jiafang.Wang
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeCompanyPerson(Request $request)
    {
        $company_person_data = [
            'user_id' => $request->user()->id,
            'company_id' => $request->user()->companyInfo->id,
            'name' => $request->input('name'),
            'manage_position' => $request->input('manage_position'),
            'manage_area' => $request->input('manage_area'),
            'manage_matters' => $request->input('manage_matters'),
            'telephone' => $request->input('telephone'),
        ];
        $lastInsertId = CompanyPerson::insertGetId($company_person_data);
        if($lastInsertId) {
            Toastr::success('更新成功');
        } else {
            Toastr::error('操作失败');
        }
        return redirect()->back();
    }

    /**
     * @desc 保存公司环境图片
     * @param Request $request
     * @since 2017/4/28 16:56
     * @author Jiafang.Wang
     */
    public function storeCompanyEnvironment(Request $request)
    {
        $this->validate($request, [
            'company_environment_url' => 'required',
        ]);
        $url_data = explode(',', $request->input('company_environment_url'));
        $insert_data = [];
        foreach ($url_data AS $url) {
            array_unshift($insert_data, [
                    'user_id' => $request->input('user_id'),
                    'company_id' => $request->input('company_id'),
                    'url' => $url,
            ]);
        }
        $res = CompanyPhoto::where([
            'user_id' => $request->input('user_id'),
            'company_id' => $request->input('company_id'),
        ])->count();
        if ($res >= 5) {
            Toastr::info('操作失败，图片数量达到上线');
            return redirect()->back();
        }
        if ($res + count($insert_data) > 5) {
            $number = 5 - $res;
            Toastr::info("操作失败，图片数量达到上线,最多可再上传" . $number . "张图片");
            return redirect()->back();
        }
        $lastInsertId = CompanyPhoto::insert($insert_data);
        if($lastInsertId) {
            Toastr::success('操作成功');
        } else {
            Toastr::error('操作失败');
        }
        return redirect()->back();
    }

    public function destroyCompanyEnvironment(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);
        $id = $request->input('id');
        $info = CompanyPhoto::find($id);
        $res = CompanyPhoto::destroy($id);
        if ($res) {
            @unlink(public_path($info['url']));
            $date['code'] = 0;
            $date['message'] = "操作成功";
            return $date;
        } else {
            $date['code'] = 1;
            $date['message'] = "操作失败";
            return $date;
        }
    }

    /**
     * @desc 申请修改公司资料
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author Jiafang.wang
     * @since 2017/5/11 9:40
     */
    public function applyModifyCompanyInfo(Request $request)
    {
        return view('member.company.apply_modify_company_info', [
            'user_id' => $request->user()->id,
            'company_id' => $request->user()->companyInfo->id,
        ]);
    }

    /**
     * @desc 保存申请请求
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @author Jiafang.wang
     * @since 2017/5/11 9:57
     */
    public function storeModifyCompanyInfo(Request $request)
    {
        $this->validate($request, [
            'reason' => 'required',
        ]);
        $info = CompanyModifyApplication::where(['company_id' => $request->input('company_id'), 'user_id' => $request->input('user_id')])->first();
        if ($info) {
            CompanyModifyApplication::where(['company_id' => $request->input('company_id'), 'user_id' => $request->input('user_id')])->update(['reason' => $request->input('reason'), 'status' => 0]);
        } else {
            CompanyModifyApplication::create($request->all());
        }
        Toastr::success('申请成功，耐心等待客服联系');
        return redirect()->route('member.company.index');
    }
}
