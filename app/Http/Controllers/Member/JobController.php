<?php
/**
 * -----------------------------------------
 * Desc: 用户中心-招聘相关控制器
 * User: Jiafang.Wang
 * Date: 2017/3/21
 * Time: 17:08
 * File: CompanyController.php
 * Project: JiongMiGame
 * -----------------------------------------
 */
namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobCategory;
use Auth;
use Toastr;
use App\Models\Company;

class JobController extends BaseController
{

    /**
     * @name index
     * @desc 个人发布首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/04/26
     * @update 2017/04/26
     */
    public function index()
    {
        $company_info = Auth::user()->companyInfo;
        if($company_info) {
            $jobs = Job::where('company_id', $company_info->id)->paginate(10);
            return view('member.job.index', [
                'jobs' => $jobs,
                'job_config' => $this->job_config,
                'province_config' => $this->province_config,
                'company_info' => $company_info,
                'is_register_company_info' => true,
            ]);
        } else {
            return view('member.job.index', [
                'is_register_company_info' => false,
            ]);
        }
    }

    /**
     * @name create
     * @desc 创建职位
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/04/26
     * @update 2017/04/26
     */
    public function create()
    {
        $company = Company::where('user_id', Auth::user()->id)->first();
        if (empty($company)) {
            Toastr::error('您还未注册公司信息');
            return redirect()->back();
        }
        if ($company->status == 0) {
            Toastr::error('您的公司信息未通过审核');
            return redirect()->back();
        }
        $job_categories = JobCategory::where(['status' => 1])->orderBy('lft')->get();
        return view('member.job.create', [
            'job_categories' => $job_categories,
            'job_config' => $this->job_config,
        ]);
    }


    /**
     * @name update
     * @desc 编辑职位
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/04/26
     * @update 2017/04/26
     */
    public function update($id)
    {
        $job_categories = JobCategory::where(['status' => 1])->orderBy('lft')->get();
        $data = Job::find($id);
        return view('member.job.update', [
            'data' => $data,
            'job_categories' => $job_categories,
            'job_config' => $this->job_config,
        ]);
    }

    /**
     * @name store
     * @desc 保存职位
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @since  2017/04/26
     * @update 2017/04/26
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'experience' => 'required',
            'salary_start' => 'required',
            'salary_end' => 'required',
            'welfare' => 'required',
            'work_address' => 'required',
            'education' => 'required',
            'type' => 'required',
            'work_conntent' => 'required',
            'job_requirements' => 'required',
        ]);
        $store_data = [
            'title' => $request->input('title'),
            'experience' => $request->input('experience'),
            'user_id' => Auth::user()->id,
            'company_id' => Auth::user()->companyInfo->id,
            'job_category_id' => $request->input('job_category_id'),
            'salary_start' => $request->input('salary_start'),
            'salary_end' => $request->input('salary_end'),
            'temptation' => implode(',', $request->input('welfare')),
            'work_address' => $request->input('work_address'),
            'education' => $request->input('education'),
            'type' => $request->input('type'),
            'work_conntent' => $request->input('work_conntent'),
            'job_requirements' => $request->input('job_requirements'),
            'province_code' => Auth::user()->companyInfo->province_code,
            'city_code' => Auth::user()->companyInfo->city_code,
            'area_code' => Auth::user()->companyInfo->area_code,
        ];
        if ($request->has('id')) {
            $id = $request->input('id');
            Job::where('id', $id)->update($store_data);
        } else {
            Job::create($store_data);
        }
        Toastr::success('操作成功');
        return redirect()->route('member.job.index');
    }

    /**
     * @desc
     * @param $id
     * @since 2017/4/27 11:24
     * @author Jiafang.Wang
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Job::where('id', $id)->update(['status' => '-1']);
        Toastr::info('操作成功');
        return redirect()->route('member.job.index');
    }

}
