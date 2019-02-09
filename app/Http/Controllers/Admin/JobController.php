<?php
/**
 * -----------------------------------------
 * Desc: 职位控制器
 * User: Jiafang.Wang
 * Date: 2017/3/20
 * Time: 18:10
 * File: JobController.php
 * Project: DoctorVisit
 * -----------------------------------------
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobCategory;
use App\Service\AddressService;

class JobController extends Controller
{
    public $job_config;

    public function index()
    {
        $data = Job::get();
        return view('admin.job.index', ['data' => $data, 'jobc' => $this->job_config]);
    }

    /**
     * @desc 更新-页面
     * @param $id
     * @since 2017/4/19 20:05
     * @author Jiafang.Wang
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update($id)
    {
        $data = Job::find($id);
        $data->welfare = explode(',', $data->temptation);
        $categories = JobCategory::orderBy('lft')->get();
        // 获取省份信息
        $provinces = AddressService::getProvince();
        return view('admin.job.update', [
            'data' => $data,
            'categories' => $categories,
            'provinces' => $provinces,
            'jobc' => $this->job_config,
            'welfare' => $this->welfare_config,
        ]);
    }

    /**
     * @desc 保存
     * @param Request $request
     * @since 2017/4/19 20:06
     * @author Jiafang.Wang
     * @return $this    
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'experience' => 'required',
            'education' => 'required',
            'type' => 'required',
            'work_conntent' => 'required',
            'job_requirements' => 'required',
        ]);

        $store_data = [
            'title' => $request->input('title'),
            'experience' => $request->input('experience'),
            'education' => $request->input('education'),
            'type' => $request->input('type'),
            'work_conntent' => $request->input('work_conntent'),
            'job_requirements' => $request->input('job_requirements'),
            'status' => $request->input('status'),
        ];

        $affect_rows = Job::where('id', $request->input('id'))->update($store_data);
        if($affect_rows) {
            return redirect()->route('admin.job.index')->withSuccess('更新成功');
        } else {
            return redirect()->route('admin.job.index')->withErrors('操作异常');
        }

    }
}