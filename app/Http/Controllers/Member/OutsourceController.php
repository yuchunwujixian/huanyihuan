<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Outsource;
use Auth;
use Toastr;

class OutsourceController extends Controller
{

    /**
     * @name index
     * @desc 发行需求榜列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/05/08
     * @update 2017/05/08
     */
    public function index()
    {
        $company_info = Auth::user()->companyInfo;
        if($company_info) {
            $data = Outsource::where(['company_id' => Auth::user()->companyInfo->id])->paginate(10);
            return view('member.outsource.index', [
                'data' => $data,
                'product_config' => $this->product_config,
                'company_info' => $company_info,
                'is_register_company_info' => true,
            ]);
        } else {
            return view('member.outsource.index', [
                'is_register_company_info' => false,
            ]);
        }
    }

    /**
     * @name create
     * @desc 发布需求
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/05/08
     * @update 2017/05/08
     */
    public function create()
    {
        return view('member.outsource.create',[
            'product_config' => $this->product_config,
        ]);
    }

    /**
     * @name store
     * @desc 更新需求
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @since  2017/05/08
     * @update 2017/05/08
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'contact' => 'required',
            'title' => 'required',
            'telephone' => 'required',
            'outsource_id' => 'required',
            'precondition_id' => 'required',
            'description' => 'required',
            'needs' => 'required',
        ]);
        $update_data = [
            'user_id' => Auth::user()->id,
            'company_id' => Auth::user()->companyInfo->id,
            'province_code' => Auth::user()->companyInfo->province_code,
            'title' => $request->input('title'),
            'contact' => $request->input('contact'),
            'telephone' => $request->input('telephone'),
            'tel_type_id' => $request->input('tel_type_id'),
            'outsource_id' => $request->input('outsource_id'),
            'precondition_id' => $request->input('precondition_id'),
            'description' => $request->input('description'),
            'needs' => $request->input('needs'),
        ];
        if ($request->has('id')) {
            $outsource_id = $request->input('id');
            $update_data['status'] = 0;
            $res = Outsource::where('id', $outsource_id)->update($update_data);
        } else {
            $res = Outsource::create($update_data);
        }
        if ($res) {
            Toastr::success("操作成功");
        } else {
            Toastr::error("操作失败");
        }
        return redirect()->route('member.publishing.outsource.index');
    }

    /**
     * @name update
     * @desc 修改需求
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/05/08
     * @update 2017/05/08
     */
    public function update($id)
    {
        $data = Outsource::where(['company_id' => Auth::user()->companyInfo->id])->where('status', '!=', -1)->find($id);
        return view('member.outsource.update', [
            'data' => $data,
            'product_config' => $this->product_config,
        ]);
    }

    /**
     * @name destroy
     * @desc 删除需求
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @since  2017/05/08
     * @update 2017/05/08
     */
    public function destroy(Request $request)
    {
        $res = Outsource::where(['id' => $request->input('id'), 'company_id' => Auth::user()->companyInfo->id])->update(['status' => '-1']);
        if ($res) {
            $date['code'] = 0;
            $date['message'] = "操作成功！！！";
            return $date;
        } else {
            $date['code'] = 1;
            $date['message'] = "操作失败！！！";
            return $date;
        }
    }
}
