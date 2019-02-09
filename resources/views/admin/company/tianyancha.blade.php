@extends('admin.layouts.base')

@section('title','公司管理')

@section('pageHeader','天眼查信息')

@section('pageDesc','DashBoard')

@section('content')
    <div class="main animsition">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <div class="box">
                        <div class="box-body">
                            <p>“{{$company->title}}”-天眼查中查询结果：</p>
                            @if($data)
                            <table id="tags-table" class="table">
                                <tr><th>注册时间</th><td>{{date("Y-m-d", $data['regTime'])}}</td></tr>
                                <tr><th>地址</th><td>{{$data['location']}}</td></tr>
                                <tr><th>注册资本</th><td>{{$data['capital']}}</td></tr>
                                <tr><th>行业</th><td>{{$data['industry']}}</td></tr>
                                <tr><th>法人代表</th><td>{{$data['legalPerson']}}</td></tr>
                                <tr><th>天眼查网址</th><td><a href="{{$data['url']}}" target="_blank">{{$data['url']}}</a></td></tr>
                            </table>
                                @else
                                <table id="tags-table" class="table">
                                    <tr>
                                        <th>天眼查中无此公司信息</th>
                                    </tr>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection