<?php
/**
 * --------------------------------------
 * Desc: 用户管理（前台）
 * User: Jiafang.Wang
 * Date: 2017/5/10 11:22
 * File: MemberController.php
 * --------------------------------------
 */


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\User;

class MemberController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(15);
        return view('admin.member.index', [
            'users' => $users,
        ]);
    }

    public function show($id)
    {
        $data = User::find($id);
        return view('admin.member.update', [
            'data' => $data,
        ]);
    }

    public function edit()
    {

    }

    public function store()
    {

    }

}