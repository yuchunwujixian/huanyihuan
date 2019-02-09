@extends('admin.layouts.base')

@section('title','短信验证记录')

@section('pageHeader','短信验证记录')

@section('pageDesc','DashBoard')

@section('content')

    <div class="row page-title-row" id="dangqian" style="margin:5px;">
        <div class="col-md-6">
            <span style="margin:3px;" id="cid" attr="" class="btn-flat text-info"> 短信验证记录</span>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                @include('admin.partials.errors')
                @include('admin.partials.success')
                <div class="box-body">
                    <table id="tags-table" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th class="hidden-sm">验证ID</th>
                            <th class="hidden-sm">验证者账号</th>
                            <th class="hidden-sm">验证码</th>
                            <th class="hidden-sm">添加时间</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($data->count())
                        @foreach($data as $v)
                            <tr>
                                <td>{{$v->id}}</td>
                                <td>{{$v->email}}</td>
                                <td>{{$v->code}}</td>
                                <td>{{$v->created_at}}</td>
                            </tr>
                        @endforeach
                            @else
                            <tr><td colspan="4" style="text-align: center">暂无数据</td></tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop

