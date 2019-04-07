<?php

namespace App\Http\Controllers\Member;

use App\Models\User;
use Illuminate\Http\Request;
use Toastr;
use Auth;
use App\Models\Company;
use App\Models\CompanyPerson;

class InfoController extends BaseController
{
    public function index(Request $request)
    {
        $data = User::find($request->user()->id);
        return view('member.info.update', ['data' => $data]);
    }

    //保存个人资料
    public function store(Request $request)
    {
//        $this->validate($request, [
//            'department' => 'required',
//            'manage_area' => 'required|max:200',
//            'manage_matters' => 'required|max:200',
//            'position' => 'required|max:200',
//            'description' => 'required|max:200',
//        ]);

        $update_data = [
            'name' => $request->input('name'),
            'avatar' => $request->input('avatar_url'),
            'department' => $request->input('department'),
            'position' => $request->input('position'),
            'manage_area' => $request->input('manage_area'),
            'manage_matters' => $request->input('manage_matters'),
            'mobile' => $request->input('mobile'),
            'description' => $request->input('description'),
        ];
        $affect_rows = User::where('id', $request->input('id'))->update($update_data);
        if ($request->user()->company_id) {
            $res = CompanyPerson::where('user_id', $request->user()->id)->first();
            if (!$res) {
                $company_person_data = [
                    'user_id' => $request->user()->id,
                    'company_id' => $request->user()->company_id,
                    'name' => $request->user()->name,
                    'manage_position' => $request->input('position'),
                    'manage_area' => $request->input('manage_area'),
                    'manage_matters' => $request->input('manage_matters'),
                    'telephone' => $request->input('mobile'),
                ];
                CompanyPerson::insert($company_person_data);
            }
        }
        if($affect_rows) {
            Toastr::success('更新成功');
            return redirect()->back();
        }
    }

    public function company(Request $request)
    {
        $company = $request->input('company');
        $companyInfo = Company::where('title', $company)->first();
        if ($companyInfo) {
            User::where('id', $request->user()->id)->update(['company_id' => $companyInfo->id]);
            if ($request->user()->mobile) {
                $company_person_data = [
                    'user_id' => $request->user()->id,
                    'company_id' => $companyInfo->id,
                    'name' => $request->user()->name,
                    'manage_position' => $request->user()->position,
                    'manage_area' => $request->user()->manage_area,
                    'manage_matters' => $request->user()->manage_matters,
                    'telephone' => $request->user()->mobile,
                ];
                CompanyPerson::insert($company_person_data);
            }
            $data['code'] = 0;
            $data['message'] = "添加成功";
            return $data;
        } else {
            $data['code'] = 1;
            $data['message'] = "该公司不存在，请先填写公司信息";
            return $data;
        }
    }
}