<?php
/**
 * --------------------------------------------
 * Desc：职业管理控制器
 * User: Bencai.Zhao
 * Date: 2017/3/17
 * Time: 11:47
 * File: JobCategoryController.php
 * --------------------------------------------
 */
namespace App\Http\Controllers\Admin;

use App\Models\Job;
use App\Models\JobCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JobCategoryController extends Controller
{
    protected $fields = [
        'parent_id',
        'lft',
        'rgt',
        'depth',
        'title',
        'status',
        'sort',
        'icon',
    ];

    /**
     * @name index
     * @desc  职位列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/03/17
     * @update 2017/03/17
     */
    public function index()
    {
        $lists = JobCategory::orderBy('lft')->get();
        return view('admin.jobcategory.index', ['lists' => $lists]);
    }

    /**
     * @name create
     * @desc  创建职位
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/03/17
     * @update 2017/03/17
     */
    public function create()
    {
        $categories = JobCategory::where('status', 1)->orderBy('lft')->get();
        return view('admin.jobcategory.create', ['categories' => $categories]);
    }

    /**
     * @desc 更新职业分类-页面
     * @param $id
     * @since date
     * @author Jiafang.Wang
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update($id)
    {
        $category = JobCategory::find($id);
        $categories = JobCategory::where('status', 1)->orderBy('lft')->get();
        return view('admin.jobcategory.update', ['category' => $category, 'categories' => $categories]);
    }
    /**
     * @name save
     * @desc 修改或添加职位
     * @param Request $request
     * @return $this
     * @since  2017/03/17
     * @update 2017/03/17
     */
    public function save(Request $request)
    {
        $this->validate($request, [
            'parent_id' => 'required',
            'title' => 'required|min:2',
            'sort' => 'numeric',
        ]);
        $update_data = [
            'title' => $request->input('title'),
            'parent_id' => $request->input('parent_id'),
            'status' => $request->input('status'),
            'sort' => $request->input('sort'),
        ];
        if ($request->has('id')) {


            JobCategory::where('id', $request->input('id'))->update($update_data);
        } else {
            if ($request->input('parent_id') == 0) {
                JobCategory::create($update_data);
            } else {
                $root = JobCategory::find($request->input('parent_id'));
                $root->children()->create(['title' => $request->input('title')]);
            }

        }
        return redirect()->route('admin.job.category.index')->withSuccess('操作成功！');

    }

    /**
     * @name del
     * @desc 删除分类
     * @param $id
     * @return $this
     * @since  2017/03/17
     * @update 2017/03/17
     */
    public function destroy($id)
    {
        $category = JobCategory::find($id);
        $jobs = $category->jobs->toArray();
        if(empty($jobs)) {
            $category->destroy($id);
            return redirect()->route('admin.job.category.index')->withSuccess( '操作成功');
        } else {
            return redirect()->route('admin.job.category.index')->withErrors( '该分类下存在职位');
        }
    }

}
