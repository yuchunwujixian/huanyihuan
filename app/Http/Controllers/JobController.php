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
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\CompanyPhoto;
use Redirect;

class JobController extends Controller
{
    /**
     * @name index
     * @desc 职位列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/3/28 22:40
     * @update 2017/3/28 22:40
     */
    public function index(Request $request)
    {
        $data = array();
        $where = [['status', '=', 1]];
        $orwhere = array();
        //地区搜索
        $province_code = !empty($request->input('province_code')) ? htmlspecialchars($request->input('province_code')) : '';
        if (!empty($province_code) && $province_code != "全国") {
            $where = array_merge($where, [['province_code', '=', $province_code]]);
        }
        //职位搜索
        $job_category_id = !empty($request->input('job_category_id')) ? htmlspecialchars($request->input('job_category_id')) : '';
        $job_category = JobCategory::where('title', $job_category_id)->first();
        if (!empty($job_category_id)) {
            $where = array_merge($where, [['job_category_id', '=', $job_category['id']]]);
        }

        //获取职位信息
        $data['job_config'] = $this->job_config;

        //性质搜索
        $type = !empty($request->input('type')) ? htmlspecialchars($request->input('type')) : '';
        if (!empty($type)) {
            $typekey = array_keys($data['job_config']['type'], $type);
            $where = array_merge($where, [['type', '=', $typekey[0]]]);
        }
        //时间搜索
        $time = !empty($request->input('time')) ? htmlspecialchars($request->input('time')) : '';
//        if (!empty($time)) {
//        
//        }
        //薪资搜索
        $salary = !empty($request->input('salary')) ? htmlspecialchars($request->input('salary')) : '';
        if (stristr($salary, '-')) {
            $salaryinfo = explode('-', $salary);
            $orwhere = $where;
            $where = array_merge($where, [['salary_start', '<=', $salaryinfo[0]]], [['salary_end', '>=', $salaryinfo[0]]]);
            $orwhere = array_merge($orwhere, [['salary_start', '=<', $salaryinfo[1]]], [['salary_end', '>=', $salaryinfo[1]]]);
        } else {
            $salaryinfo = substr($salary, 0, -6);
            if ($salaryinfo < 10000) {
                $where = array_merge($where, [['salary_end', '<=', $salaryinfo]]);
            } else {
                $where = array_merge($where, [['salary_start', '>=', $salaryinfo]]);
            }
        }
        //获取所有参数传到前端
        $data['parameter'] = array(
            "province_code" => $province_code,
            "job_category_id" => $job_category_id,
            "salary" => $salary,
            "type" => $type,
            "time" => $time
        );

        //获取省事信息
        $data['province'] = $this->province_config;
        //获得职位信息
        $data['jobcategories'] = JobCategory::where(['status' => 1, 'parent_id' => 0])->orderBy('lft')->get();
        foreach ($data['jobcategories'] as $k => $v) {
            $data['jobcategories'][$k]->child = $v->getDescendants()->toHierarchy()->toArray();
        }

        //获取工作
        if (!empty($orwhere)) {
            $data['jobs'] = Job::where($where)->orWhere($orwhere)->orderBy('updated_at', 'desc')->paginate(2);
        } else {
            $data['jobs'] = Job::where($where)->orderBy('updated_at', 'desc')->paginate(2);
        }
        return view('job.index', $data);
    }



    public function index2(Request $request, $province_code = 0, $category_id = 0, $salary = 0, $type = 0, $time = 0)
    {
        $query = Job::orderBy('id', 'desc')->where('status', 1);
        if($province_code) {
            $query = $query->where('province_code', $province_code);
        }
        if($category_id) {
            $query = $query->where('job_category_id', $category_id);
        }

        if ($salary) {
            $salary_array = explode('-', $salary);
            $query = $query->whereBetween('salary_start', [$salary_array[0], $salary_array[1]])->orWhereBetween('salary_end', [$salary_array[0], $salary_array[1]]);
        }

        if($type) {
            $query = $query->where('type', $type);
        }

        if($time) {
            $query = $query->where('created_at', '<', strtotime("- {$time} days"));
        }

        $lists = $query->get();

        $parent_job_categories = JobCategory::where(['status' => 1, 'parent_id' => 0])->orderBy('lft')->get();
        $categories = array();
        foreach ($parent_job_categories AS $key => $category) {
            $categories[$key]['child'] = JobCategory::find($category->id)->children;
        }

        //当前选中的职业分类
        if($category_id) {
            $current_category_model = JobCategory::find($category_id);
        }

        return view('job.index2', [
            'job_config' => $this->job_config,
            'province_config' => $this->province_config,
            'lists' => $lists,
            'total' => $lists->count(),
            'province' => $this->province_config,
            'parent_job_categories' => $parent_job_categories,
            'categories' => $categories,
            'province_code' => $province_code,
            'province_name' => $province_code ? $this->province_config[$province_code] : '',
            'category_id' => $category_id,
            'category_name' => $category_id ? $current_category_model->title : '',
            'salary' => $salary,
            'salary_name' => $salary ? $salary : '',
            'type' => $type,
            'type_name' => $type ? $this->job_config['type'][$type] : '',
            'time' => $time,
            'time_name' => $time ? $time.'天内' : '',
        ]);
    }
    /**
     * @name show
     * @desc 职位详细
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  date
     * @update date
     */
    public function show($id)
    {
        $data = Job::find($id);
        if(empty($data)) {
           return  redirect()->route('job.index');
        }
        $all_of_jobs = $data->companyInfo->publishJobs;
        $company_photos = CompanyPhoto::where('company_id', $data->companyInfo->id)->get();
        return view('job.show', [
            'job_config' => $this->job_config,
            'data' => $data,
            'all_of_jobs' => $all_of_jobs,
            'company_photos' => $company_photos
        ]);
    }

}
