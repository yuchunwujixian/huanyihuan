<?php
/**
 * 渠道需求榜
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ChannelDemand;

class ChannelDemandController extends Controller
{
    public function index()
    {
        $data = ChannelDemand::orderBy('id', 'desc')->get();
        return view('admin.channelDemand.index', [
            'data' => $data,
            'product_config' => $this->product_config,
            'province_config' => $this->province_config,
        ]);
    }

    public function update($id)
    {
        $data = ChannelDemand::find($id);
        return view('admin.channelDemand.update', [
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
        $affect_rows = ChannelDemand::where('id', $request->input('id'))->update($store_data);
        if($affect_rows) {
            return redirect()->route('admin.channel.demand.index')->withSuccess('更新成功');
        } else {
            return redirect()->route('admin.channel.demand.index')->withErrors('操作异常');
        }
    }

    public function destroy(Request $request)
    {
        $res = ChannelDemand::destroy($request->input('id'));
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
