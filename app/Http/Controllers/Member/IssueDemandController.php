<?php
/**
 * 发行需求榜控制器
 */
namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Models\IssueDemand;
use Auth;
use Toastr;

class IssueDemandController extends BaseController
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
            $data = IssueDemand::where(['company_id' => Auth::user()->companyInfo->id])->paginate(10);
            return view('member.issueDemand.index', [
                'data' => $data,
                'product_config' => $this->product_config,
                'company_info' => $company_info,
                'is_register_company_info' => true,
            ]);
        } else {
            return view('member.issueDemand.index', [
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
        return view('member.issueDemand.create',[
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
            'telephone' => 'required',
            'cooperation_id' => 'required',
            'platform_id' => 'required',
            'game_type_id' => 'required',
            'type_id' => 'required|Numeric',
            'area_id' => 'required|Numeric',
            'description' => 'required',
            'needs' => 'required',
        ]);
        $update_data = [
            'user_id' => Auth::user()->id,
            'company_id' => Auth::user()->companyInfo->id,
            'province_code' => Auth::user()->companyInfo->province_code,
            'contact' => $request->input('contact'),
            'telephone' => $request->input('telephone'),
            'tel_type_id' => $request->input('tel_type_id'),
            'cooperation_id' => implode(',', $request->input('cooperation_id')),
            'platform_id' => implode(',', $request->input('platform_id')),
            'game_type_id' => $request->input('game_type_id'),
            'type_id' => $request->input('type_id'),
            'area_id' => $request->input('area_id'),
            'description' => $request->input('description'),
            'needs' => $request->input('needs'),
        ];
        if ($request->has('id')) {
            $IssueDemand_id = $request->input('id');
            $update_data['status'] = 1;
            $res = IssueDemand::where('id', $IssueDemand_id)->update($update_data);
        } else {
            $IssueDemand = new IssueDemand();
            foreach ($update_data as $key => $value) {
                $IssueDemand->$key = $value;
            }
            $res = $IssueDemand->save();
        }
        if ($res) {
            Toastr::success("操作成功");
        } else {
            Toastr::error("操作失败");
        }
        return redirect()->route('member.publishing.issueDemand.index');
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
        $data = IssueDemand::where(['company_id' => Auth::user()->companyInfo->id])->where('status', '!=', -1)->find($id);
        return view('member.issueDemand.update', [
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
        $res = IssueDemand::where(['id' => $request->input('id'), 'company_id' => Auth::user()->companyInfo->id])->update(['status' => '-1']);
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
