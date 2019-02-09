@extends('admin.layouts.base')

@section('title','发布需求榜')

@section('pageHeader','发布需求榜')

@section('pageDesc','DashBoard')

@section('content')

    <div class="main animsition">
        <div class="container-fluid">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">发布需求榜信息</h3>
                    </div>
                    <div class="panel-body">
                        @include('admin.partials.errors')
                        @include('admin.partials.success')
                        <form class="form-horizontal" role="form" method="POST" action="{{route('admin.issue.demand.store')}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="id" value="{{ $data->id }}">

                            <div class="form-group">
                                <label for="tag" class="col-md-3 control-label">产品类型</label>
                                <div class="col-md-6">
                                    <span class="radio-inline">
                                        {{$product_config['game_type_issue'][$data->game_type_id]}}
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tag" class="col-md-3 control-label">发布者</label>
                                <div class="col-md-6">
                                    <span class="radio-inline">{{$data->userInfo->name}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tag" class="col-md-3 control-label">发布公司</label>
                                <div class="col-md-6">
                                    <span class="radio-inline">{{$data->companyInfo->title}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tag" class="col-md-3 control-label">发布地区</label>
                                <div class="col-md-6">
                                    <span class="radio-inline">{{$province_config[$data->province_code]}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tag" class="col-md-3 control-label">联系人</label>
                                <div class="col-md-6">
                                    <span class="radio-inline">{{ $data->contact }}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tag" class="col-md-3 control-label">联系方式</label>
                                <div class="col-md-6">
                                    <span class="radio-inline">{{ $product_config['tel_type'][$data->tel_type_id] }} ： {{ $data->telephone }}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tag" class="col-md-3 control-label">合作方式</label>
                                <div class="col-md-6">
                                    <span class="radio-inline">
                                        @foreach(explode(',', $data->cooperation_id) as $key => $value)
                                            {{$product_config['cooperation'][$value]}}|
                                        @endforeach
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tag" class="col-md-3 control-label">平台</label>
                                <div class="col-md-6">
                                    <span class="radio-inline">
                                    @foreach($data->platformInfo($data->platform_id) as $v)
                                                {{$product_config['platform'][$v]}} |
                                    @endforeach
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tag" class="col-md-3 control-label">区分</label>
                                <div class="col-md-6">
                                    <span class="radio-inline">{{ $product_config['type'][$data->type_id] }}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tag" class="col-md-3 control-label">代理区域</label>
                                <div class="col-md-6">
                                    <span class="radio-inline">{{ $product_config['area'][$data->area_id] }}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tag" class="col-md-3 control-label">产品介绍</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" rows="10" name="description">{{ $data->description }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tag" class="col-md-3 control-label">需求及合作</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" rows="10" name="needs">{{ $data->needs }}</textarea>
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
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="-1" @if($data->status == -1) checked @endif> 删除
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
