@extends('admin.layouts.base')

@section('title','产品研发榜')

@section('pageHeader','产品研发榜')

@section('pageDesc','DashBoard')

@section('content')

    <div class="main animsition">
        <div class="container-fluid">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">产品研发榜信息</h3>
                    </div>
                    <div class="panel-body">
                        @include('admin.partials.errors')
                        @include('admin.partials.success')
                        <form class="form-horizontal" role="form" method="POST" action="{{route('admin.product.store')}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="id" value="{{ $data->id }}">

                            <div class="form-group">
                                <label for="tag" class="col-md-3 control-label">产品名称</label>
                                <div class="col-md-6">
                                    <span class="radio-inline">{{$data->title}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tag" class="col-md-3 control-label">logo</label>
                                <div class="col-md-6">
                                    @if($data->logo)
                                        <img src="{{ $data->logo }}" width="120px">
                                    @else
                                        <em>未上传图片</em>
                                    @endif
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
                                    <span class="radio-inline">{{ $product_config['cooperation'][$data->cooperation_id] }}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tag" class="col-md-3 control-label">阶段</label>
                                <div class="col-md-6">
                                    <span class="radio-inline">{{ $product_config['period'][$data->period_id] }}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tag" class="col-md-3 control-label">平台</label>
                                <div class="col-md-6">
                                    <span class="radio-inline">
                                        @foreach(explode(',', $data->platform_id) as $key => $value)
                                            {{$product_config['platform'][$value]}}/
                                        @endforeach
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tag" class="col-md-3 control-label">游戏分类</label>
                                <div class="col-md-6">
                                    <span class="radio-inline">{{ $product_config['game_type'][$data->game_type_id] }}</span>
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
                                <label for="province" class="col-md-3 control-label">下载链接</label>
                                <div class="col-md-6">
                                    <span class="radio-inline">{{ $data->url }}</span>
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
                                <label for="tag" class="col-md-3 control-label">产品截图</label>
                                <div class="col-md-6">
                                    @if($data->productPhotos->count())
                                        @foreach ($data->productPhotos as $value)
                                            <img src="{{ $value->url }}" width="120px">
                                        @endforeach
                                    @else
                                        <em>未上传图片</em>
                                    @endif
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
