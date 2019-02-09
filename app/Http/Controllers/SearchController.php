<?php
/**
 * -----------------------------------------
 * Desc:
 * User: Jiafang.Wang
 * Date: 2017/3/24
 * Time: 13:48
 * File: CompanyController.php
 * Project: DoctorVisit
 * -----------------------------------------
 */

namespace App\Http\Controllers;


use App\Models\Company;
use Illuminate\Http\Request;
use Validator;
use App\Models\Product;

class SearchController extends Controller
{

    public function index(Request $request)
    {
        $messages = [
            'condition.required' => '筛选条件不能为空',
        ];

        $validator = Validator::make($request->all(), [
            'type_search' => 'required',
            'condition' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator);
        }

        $type = intval($request->input('type_search'));
        $condition = trim($request->input('condition'));
        if ($type == 1) {
            $data = Company::where('status', 1)->where('title', 'LIKE', '%'.$condition.'%')->orderBy('id', 'desc')->get();
            if ($data->count() > 0) {
                return view('search.company', [
                    'data' => $data,
                ]);
            } else {
                return view('search.noresult', ['condition' => $condition]);
            }
        } elseif ($type == 2) {
            $data = Product::where('status', 1)->where('title', 'LIKE', '%'.$condition.'%')->orderBy('id', 'desc')->get();
            if ($data->count() > 0) {
                return view('search.product', [
                    'data' => $data,
                    'product_config' => $this->product_config,
                ]);
            } else {
                return view('search.noresult', ['condition' => $condition]);
            }
        }
        return view('search.noresult');
    }


    public function noresult()
    {
        return view('search.noresult');
    }
}