<?php
/**
 * 发布需求榜
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IssueDemand;

class IssueDemandController extends Controller
{
    public function index()
    {
        $data = IssueDemand::orderBy('id', 'desc')->get();
        return view('admin.issueDemand.index', [
            'data' => $data,
            'product_config' => $this->product_config,
            'province_config' => $this->province_config,
        ]);
    }

    public function update($id)
    {
        $data = IssueDemand::find($id);
        return view('admin.issueDemand.update', [
            'data' => $data,
            'product_config' => $this->product_config,
            'province_config' => $this->province_config,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
        ]);
        $store_data = [
            'status' => $request->input('status'),
        ];
        $affect_rows = IssueDemand::where('id', $request->input('id'))->update($store_data);
        if($affect_rows) {
            return redirect()->route('admin.issue.demand.index')->withSuccess('更新成功');
        } else {
            return redirect()->route('admin.issue.demand.index')->withErrors('操作异常');
        }
    }

    public function destroy(Request $request)
    {
        $res = IssueDemand::destroy($request->input('id'));
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
