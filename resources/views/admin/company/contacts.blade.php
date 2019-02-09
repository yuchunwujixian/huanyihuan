@extends('admin.layouts.base')

@section('title','控制面板')

@section('pageHeader','控制面板')

@section('pageDesc','DashBoard')

@section('content')
    <div class="main animsition">
        <div class="container-fluid">

            <div class="row">
                <div class="">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">公司联系人信息</h3>
                        </div>
                        <div class="panel-body">
                            @include('admin.partials.errors')
                            @include('admin.partials.success')
                            <table class="table">
                                <tr>
                                    <th>姓名</th>
                                    <th>职务</th>
                                    <th>负责区域</th>
                                    <th>负责事宜</th>
                                    <th>联系方式</th>
                                </tr>
                                @foreach($lists AS $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->name}}</td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection