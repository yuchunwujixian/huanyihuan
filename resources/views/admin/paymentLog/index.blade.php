@extends('admin.layouts.base')

@section('title','充值记录')

@section('pageHeader','充值记录')

@section('pageDesc','DashBoard')

@section('content')

    <div class="row page-title-row" id="dangqian" style="margin:5px;">
        <div class="col-md-6">
            <span style="margin:3px;" id="cid" attr="" class="btn-flat text-info"> 充值记录</span>
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
                            <th class="hidden-sm">充值ID</th>
                            <th class="hidden-sm">充值者姓名</th>
                            <th class="hidden-sm">充值者账号</th>
                            <th class="hidden-md">充值金额（元）</th>
                            <th class="hidden-md">充值方式</th>
                            <th class="hidden-sm">充值状态</th>
                            <th class="hidden-sm">充值时间</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($data->count())
                        @foreach($data as $v)
                            <tr>
                                <td>{{$v->id}}</td>
                                <td>{{$v->userInfo->name}}</td>
                                <td>{{$v->userInfo->mobile}}</td>
                                <td>{{$v->account}}</td>
                                <td>{{$v->payment}}</td>
                                <td>
                                    @if($v->status == 1)
                                        <button type="button" class="btn btn-success btn-xs">
                                            成功
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-xs">
                                            失败
                                        </button>
                                    @endif</td></td>
                                <td>{{$v->created_at}}</td>
                            </tr>
                        @endforeach
                            @else
                            <tr><td colspan="7" style="text-align: center">暂无数据</td></tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop

