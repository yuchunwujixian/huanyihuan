@extends('admin.layouts.base')

@section('title','用户详情')

@section('pageHeader','用户详情')

@section('pageDesc','DashBoard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><a href="#" style="color: #31708f">用户详细信息</a></h3>
                    </div>
                    <div class="panel-body">
                        @include('admin.partials.errors')
                        @include('admin.partials.success')
                        <style>.form-horizontal .control-label {padding-top: 0}</style>
                        <form class="form-horizontal" role="form" method="POST" action="">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{$data->id}}">
                            <div class="form-group">
                                <label for="sort" class="col-md-3 control-label">用户名</label>
                                <div class="col-md-6">
                                    {{$data->name}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sort" class="col-md-3 control-label">邮箱</label>
                                <div class="col-md-6">
                                    {{$data->email}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sort" class="col-md-3 control-label">手机</label>
                                <div class="col-md-6">
                                    {{$data->mobile}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sort" class="col-md-3 control-label">公司</label>
                                <div class="col-md-6">
                                    {{$data->company_id}}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-7 col-md-offset-3">
                                    <button type="button" class="btn btn-primary">保存</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop