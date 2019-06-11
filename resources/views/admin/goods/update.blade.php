@extends('admin.layouts.base')

@section('title', $title)

@section('css')
    <style>
        #carousel-ad img{
            width: 23%;
            max-height: 150px;
            display: inline-block;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ $title }}</h3>
                    </div>
                    <div class="panel-body">
                        @include('admin.partials.errors')
                        @include('admin.partials.success')
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.goods.save') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{$data->id}}">
                            <div class="form-group">
                                <label class="col-md-3 control-label">商品名称</label>
                                <div class="col-md-8">
                                    <span class="radio-inline">{{$data->title}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">商品标题</label>
                                <div class="col-md-8">
                                    <span class="radio-inline">{{$data->long_title}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">商品价值</label>
                                <div class="col-md-8">
                                    <span class="radio-inline text-danger">¥<strong>{{ $data->price }}</strong></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">发布者</label>
                                <div class="col-md-8">
                                    <span class="radio-inline">{{$data->user->name}}(状态：@if($data->user->status)<span class="label label-info">正常</span>@else <span class="label label-danger">禁用</span> @endif)</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">商品分类</label>
                                <div class="col-md-8">
                                    <span class="radio-inline">{{$data->category->title}}(状态：@if($data->category->status)<span class="label label-info">正常</span>@else <span class="label label-danger">禁用</span> @endif)</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">主图片地址</label>
                                <div class="col-md-8">
                                    <img src="{{ $data->third_img_url }}" class="img-rounded" style="max-width: 100px;max-height: 100px;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">商品轮播图</label>
                                <div class="col-md-8">
                                    <div id="carousel-ad" class="carousel slide" data-ride="carousel"  data-interval="2000">
                                        <div class="carousel-inner" role="listbox">
                                            @if($data->imgs)
                                            @foreach ($data->imgs->chunk(4) as $chunks)
                                                <div class="item @if($loop->index == 0) active @endif">
                                                    @foreach ($chunks as $value)
                                                    <img class="img-responsive" src="{{ asset('storage/'.$value->third_img_url) }}">
                                                    @endforeach
                                                </div>
                                            @endforeach
                                            @else
                                                暂无轮播图
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">商品描述</label>
                                <div class="col-md-8 row pre-scrollable">
                                    {!! $data->description !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-md-3 control-label">是否显示</label>
                                <div class="col-md-8">
                                    @foreach($goods_status as $k => $v)
                                        <label class="radio-inline">
                                            <input type="radio" name="status" value="{{$k}}" @if($data->status == $k)checked @endif> {{ $v }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-3">
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