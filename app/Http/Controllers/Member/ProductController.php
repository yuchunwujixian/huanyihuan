<?php
/**
 * 产品研发榜控制器
 */
namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use Toastr;
use Auth;
use App\Models\Product;
use App\Models\ProductPhoto;
use App\Models\ProductPerson;

class ProductController extends BaseController
{

    /**
     * @name index
     * @desc  发布需求列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/05/07
     * @update 2017/05/07
     */
    public function index()
    {
        $company_info = Auth::user()->companyInfo;
        if($company_info) {
            $data = Product::where(['company_id' => Auth::user()->companyInfo->id])->paginate(10);
            return view('member.product.index', [
                'data' => $data,
                'product_config' => $this->product_config,
                'company_info' => $company_info,
                'is_register_company_info' => true,
            ]);
        } else {
            return view('member.product.index', [
                'is_register_company_info' => false,
            ]);
        }
    }
    /**
     * @name create
     * @desc  添加产品信息
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/05/05
     * @update 2017/05/05
     */
    public function create()
    {
        return view('member.product.create',[
            'product_config' => $this->product_config,
        ]);
    }

    /**
     * @name update
     * @desc  修改需求
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/05/07
     * @update 2017/05/07
     */
    public function update($id)
    {
        $data = Product::where(['company_id' => Auth::user()->companyInfo->id])->where('status', '!=', -1)->find($id);
        return view('member.product.update', [
            'data' => $data,
            'product_config' => $this->product_config,
        ]);
    }

    /**
     * @name store
     * @desc  修改或添加需求
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @since  2017/05/07
     * @update 2017/05/07
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'contact' => 'required',
            'telephone' => 'required',
            'cooperation_id' => 'required|Numeric',
            'period_id' => 'required|Numeric',
            'platform_id' => 'required',
            'game_type_id' => 'required|Numeric',
            'type_id' => 'required|Numeric',
            'area_id' => 'required|Numeric',
            'url' => 'required',
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
            'cooperation_id' => $request->input('cooperation_id'),
            'period_id' => $request->input('period_id'),
            'platform_id' => implode(',', $request->input('platform_id')),
            'game_type_id' => $request->input('game_type_id'),
            'type_id' => $request->input('type_id'),
            'area_id' => $request->input('area_id'),
            'url' => $request->input('url'),
            'description' => $request->input('description'),
            'needs' => $request->input('needs'),
        ];
        if ($request->has('id')) {
            $product_id = $request->input('id');
            if ($request->has('logo')) {
                $update_data['logo'] = $request->input('logo');
                $info = Product::find($product_id);
                @unlink(public_path($info->logo));
            }
            $update_data['status'] = 1;
            $res = Product::where('id', $product_id)->update($update_data);
        } else {
            $update_data['logo'] = $request->input('logo');
            $product = new Product();
            foreach ($update_data as $key => $value) {
                $product->$key = $value;
            }
            $res = $product->save();
            $product_id = $product->id;
        }
        if ($res && $request->has('product_url')) {
            $url_data = explode(',', $request->input('product_url'));
            $insert_data = [];
            foreach ($url_data AS $url) {
                array_unshift($insert_data, [
                    'user_id' => Auth::user()->id,
                    'company_id' => Auth::user()->companyInfo->id,
                    'product_id' => $product_id,
                    'url' => $url,
                ]);
            }
            ProductPhoto::insert($insert_data);
        }
        if ($res) {
            Toastr::success("操作成功");
        } else {
            Toastr::error("操作失败");
        }
        return redirect()->route('member.publishing.product.index');
    }

    /**
     * @name destroy
     * @desc  删除需求
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @since  2017/05/07
     * @update 2017/05/08
     */
    public function destroy(Request $request)
    {
        $res = Product::where(['id' => $request->input('id'), 'company_id' => Auth::user()->companyInfo->id])->update(['status' => '-1']);
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

    /**
     * @name storeProductPerson
     * @desc  添加产品联系人
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @since  2017/05/12
     * @update 2017/05/12
     */
    public function storeProductPerson(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'id' => 'required',
            'job' => 'required',
            'area' => 'required',
            'charge' => 'required',
            'tel_type' => 'required|Numeric',
            'tel_phone' => 'required',
            'type' => 'required|Numeric',
        ]);
        $res = Product::where(['id' => $request->input('id'), 'company_id' => Auth::user()->companyInfo->id, 'user_id' => Auth::user()->id])->first();
        if (empty($res)) {
         Toastr::error('操作失败');
        return redirect()->back();
        }
        $product_person_data = [
            'user_id' => $request->user()->id,
            'company_id' => $request->user()->companyInfo->id,
            'product_id' => $request->input('id'),
            'name' => $request->input('name'),
            'job' => $request->input('job'),
            'area' => $request->input('area'),
            'charge' => $request->input('charge'),
            'tel_type' => $request->input('tel_type'),
            'tel_phone' => $request->input('tel_phone'),
            'type' => $request->input('type'),
        ];
        $lastInsertId = ProductPerson::insertGetId($product_person_data);
        if($lastInsertId) {
            Toastr::success('添加成功');
        } else {
            Toastr::error('操作失败');
        }
        return redirect()->back();
    }
}
