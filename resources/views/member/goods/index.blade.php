@extends('public.base')

@section('title', $title)

@section('uc_here', $uc_here)

@section('css')
@endsection

@section('content')
    @include('public.member_header')
    <div class="container">
        <div class="row">
            <div class="col-sm-4 hidden-xs">
                @include('public.member_left')
            </div>
            <div class="col-xs-1 visible-xs"></div>
            <div class="col-xs-10 col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @if(count($goods))
                            <div class="row same-height">
                                @foreach($goods as $good)
                                    <div class="col-sm-6 col-md-4 col-lg-3 ">
                                        <div class="thumbnail">
                                            <a href="http://www.youzhan.org/" title="{{ $good->title }}" target="_blank">
                                                <img class="lazy" src="{{asset('storage/'.$good->img_url)}}" data-src="{{asset('storage/'.$good->img_url)}}" alt="{{ $good->title }}" data-img-default="/img/default_cover.png">
                                            </a>
                                            <div class="caption">
                                                <h3>
                                                    <a href="http://www.youzhan.org/" title="Bootstrap 优站精选" target="_blank">
                                                        {{ $good->title }}
                                                    </a>
                                                    <small><span class="text-danger">¥<strong>{{ $good->price }}</strong></span></small>
                                                </h3>
                                                <p class="cursor" data-toggle="tooltip" title="{{ $good->long_title }}">{{ str_limit($good->long_title, 56) }}</p>
                                                <div>
                                                    <div class="display-inline">收藏：{{ $good->collect_count }}</div>
                                                    <div class="display-inline fr">浏览：{{ $good->view_count }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="page text-center">
                                {{ $goods->links() }}
                            </div>
                        @else
                            <div>
                                <h3 class="text-center">暂无数据</h3>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection