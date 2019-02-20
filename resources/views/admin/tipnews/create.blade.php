@extends('admin.layouts.base')

@section('title', $title)

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">增加tipnews</h3>
                    </div>
                    <div class="panel-body">
                        @include('admin.partials.errors')
                        @include('admin.partials.success')
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.tipnews.save') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label class="col-md-3 control-label">消息主题</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="title">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">跳转地址</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="url">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">排序</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="sort" value="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">是否显示</label>
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
                                <div class="col-md-7 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary">保存</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
