@extends('admin.layouts.base')

@section('title','查看帖子')

@section('pageHeader','查看帖子')

@section('pageDesc','DashBoard')

@section('content')

    <div class="main animsition">
        <div class="container-fluid">
            <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">编辑帖子信息</h3>
                        </div>
                        <div class="panel-body">
                            @include('admin.partials.errors')
                            @include('admin.partials.success')
                            <form class="form-horizontal" role="form" method="POST" action="{{route('admin.community.store')}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="id" value="{{ $data->id }}">

                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">发布者</label>
                                    <div class="col-md-6">
                                        <span class="radio-inline">{{$data->userInfo->mobile}} （用户名：{{ $data->userInfo->name }} ）</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">内容</label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" rows="10" name="description">{{ $data->content }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">图片浏览</label>
                                    <div class="col-md-6">
                                        @if($data->attachesInfo->count())
                                            @foreach ($data->attachesInfo as $value)
                                            <img src="{{ $value->url }}" width="100px">
                                            @endforeach
                                        @else
                                            <em>未上传图片</em>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="province" class="col-md-3 control-label">点赞数</label>
                                    <div class="col-md-6">
                                        <span class="radio-inline">{{ $data->points }}</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">收藏数</label>
                                    <div class="col-md-6">
                                        <span class="radio-inline">{{ $data->collects }}</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">评论数</label>
                                    <div class="col-md-6">
                                        <span class="radio-inline">{{ $data->comments }}</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">被举报次数</label>
                                    <div class="col-md-6">
                                        <span class="radio-inline">{{ $data->postReports($data->id) }}</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">实名状态</label>
                                    <div class="col-md-6">
                                        <label class="radio-inline">
                                            <input type="radio" @if($data->is_anonymity == 0) checked @endif disabled> 实名
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" @if($data->is_anonymity == 1) checked @endif disabled> 匿名
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">状态</label>
                                    <div class="col-md-6">
                                        <label class="radio-inline">
                                            <input type="radio" name="status" value="1" @if($data->status == 1) checked @endif> 正常
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="status" value="0" @if($data->status == 0) checked @endif> 禁用
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-7 col-md-offset-3">
                                        <button type="submit" class="btn btn-primary btn-md">
                                            <i class="fa fa-plus-circle"></i>
                                            保存
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
