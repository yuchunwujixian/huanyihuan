<?php
/**
 * 产品研发榜控制器
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductPhoto;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::orderBy('id', 'desc')->get();
        return view('admin.product.index', [
            'data' => $data,
            'product_config' => $this->product_config,
            'province_config' => $this->province_config,
        ]);
    }

    public function update($id)
    {
        $data = Product::find($id);
        return view('admin.product.update', [
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
        $affect_rows = Product::where('id', $request->input('id'))->update($store_data);
        if($affect_rows) {
            return redirect()->route('admin.product.index')->withSuccess('更新成功');
        } else {
            return redirect()->route('admin.product.index')->withErrors('操作异常');
        }
    }

    public function destroy(Request $request)
    {
        $data = Product::find($request->input('id'));
        $res = Product::destroy($request->input('id'));
        if ($res) {
            @unlink(public_path($data->logo));
            foreach ($data->productPhotos as $value) {
                @unlink(public_path($value->url));
            }
            ProductPhoto::where('product_id', $request->input('id'))->delete();
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
