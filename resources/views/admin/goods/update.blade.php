@extends('admin.layouts.base')

@section('title', $title)

@section('css')
    <link rel="stylesheet" href="/dist/css/swiper-3.4.2.min.css" />
    <style>
        .game-wrapper{
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
                                    <img src="{{ asset('storage/'.$data->img_url) }}" class="img-rounded" style="max-width: 100px;max-height: 100px;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">商品轮播图</label>
                                <div class="col-md-8">
                                    <div class="swiper-container">
                                        <div class="swiper-wrapper">
                                            @foreach ($data->imgs->chunk(4) as $chunks)
                                                <div class="swiper-slide">
                                                    @foreach ($chunks as $value)
                                                        <div class="game-wrapper">
                                                            <img src="{{ asset('storage/'.$value->img_url) }}"/>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>
                                        <!-- 导航按钮 -->
                                        <div class="swiper-button-prev"></div>
                                        <div class="swiper-button-next"></div>
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
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="1" @if($data->status == 1)checked @endif> 是
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="0" @if($data->status == 0)checked @endif> 否
                                    </label>
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
@section('js')
    <script src="/dist/js/swiper-3.4.2.jquery.min.js"></script>
    <script type="text/javascript">
    </script>
@endsection