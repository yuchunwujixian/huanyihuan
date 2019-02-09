@extends('admin.layouts.base')

@section('title','游戏详情')

@section('pageHeader','游戏详情')

@section('pageDesc','DashBoard')

@section('content')
    <div class="main animsition">
        <div class="container-fluid">

            <div class="row">
                <div class="">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">编辑游戏信息</h3>
                        </div>
                        <div class="panel-body">

                            @include('admin.partials.errors')
                            @include('admin.partials.success')
                            <form class="form-horizontal" role="form" method="POST" action="{{route('admin.game.update')}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <input type="hidden" name="company_id" value="{{ $data->company_id }}">
                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">游戏名称</label>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" name="title" value="{{ $data->title }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">运营公司</label>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" value="{{ $data->companyInfo->title }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">研发公司</label>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" value="{{ $data->company }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="type_id" class="col-md-3 control-label">所属分类</label>
                                    <div class="col-md-5">
                                        <select class="form-control" name="type_id" id="type_id">
                                            <option>请选择</option>
                                            @foreach($jobc['game_type'] as $key => $val)
                                                <option value="{{$key}}" @if($data->type_id == $key) selected @endif >{{$val}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="url" class="col-md-3 control-label">下载地址</label>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" name = "url" value="{{ $data->url }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">研发方联系人</label>
                                    <div class="col-md-5">
                                        @foreach($data->gameContact()->where('type', 1)->get() as $key => $val)
                                        <div class="form-control">姓名：{{$val['name']}} -- 联系电话： {{$val['tel_phone']}} </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">运营方方联系人</label>
                                    <div class="col-md-5">
                                        @foreach($data->gameContact()->where('type', 0)->get() as $key => $val)
                                            <div class="form-control">姓名：{{$val['name']}} -- 联系电话： {{$val['tel_phone']}}  </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="needs" class="col-md-3 control-label">需求目标</label>
                                    <div class="col-md-5">
                                        <textarea name="needs" class="form-control" rows="8">{{ $data->needs }}</textarea>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="content" class="col-md-3 control-label">游戏介绍</label>
                                    <div class="col-md-5">
                                        <textarea name="content" class="form-control" rows="8">{{ $data->content }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">状态</label>
                                    <div class="col-md-5">
                                        <label class="radio-inline">
                                            <input type="radio" name="status" value="1" @if($data->status == 1) checked @endif> 通过
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="status" value="0" @if($data->status == 0) checked @endif> 待审核
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
    </div>
@endsection