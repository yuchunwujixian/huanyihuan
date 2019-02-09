@extends('admin.layouts.base')

@section('title','福利创建')

@section('pageHeader','福利创建')

@section('pageDesc','DashBoard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">添加福利</h3>
                    </div>
                    <div class="panel-body">
                        @include('admin.partials.errors')
                        @include('admin.partials.success')
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.welfare.save') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="sort" class="col-md-3 control-label">名称</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="title">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-md-3 control-label">是否显示</label>
                                <div class="col-md-6">
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="1" checked> 是
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="0"> 否
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sort" class="col-md-3 control-label">排序</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="sort" value="0">
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
