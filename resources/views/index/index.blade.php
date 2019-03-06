@extends('public.base')

@section('title', $title)

@section('css')
    <link rel="stylesheet" href="/dist/css/home.css">
@endsection

@section('js')
    <script src="/dist/js/home.js"></script>
@endsection

@section('content')
    <!-- 中部banner区域 -->
    <div class="banner">
        @include('public.banner')
        <div class="container">
            <div class="search-wrapper">
                <input type="text" class="col-lg-9 col-xs-9" placeholder="查找商品">
                <div class="search">
                    <span class="glyphicon glyphicon-search"></span>
                </div>
            </div>
        </div>
    </div>
    <!-- 中部周榜区域 -->
    <div class="container">
        <div class="week-list">
            <div class="week-list-head">
                <h2 class="week-list-title">从此开启美好生活</h2>
                <p class="week-list-comment">Start a good life from now on</p>
            </div>
            <!-- 专题 -->
            @foreach($topics as $v)
                <div class="row font-22 margin-b-10">
                    <div class="display-inline">
                        {{ $v->title }}
                    </div>
                    <div class="display-inline font-16">
                        <a href="javascript:;" class="color-aaa">更多<i class="glyphicon glyphicon-chevron-right"></i></a>
                    </div>
                </div>
                <div class="row">
                    @foreach($v->goods as $good)
                        <div class="col-sm-6 col-md-4 col-lg-3 ">
                            <div class="thumbnail height-250">
                                <a href="http://www.youzhan.org/" title="Bootstrap 优站精选" target="_blank">
                                    <img class="lazy" src="/dist/img/head_logo.png" data-src="/dist/img/head_logo.png" alt="Bootstrap 优站精选">
                                </a>
                                <div class="caption">
                                    <h3>
                                        <a href="http://www.youzhan.org/" title="Bootstrap 优站精选" target="_blank">{{ $good->title }}<small> Bootstrap 网站实例</small></a>
                                    </h3>
                                    <p>Bootstrap 优站精选频道收集了众多基于 Bootstrap 构建、设计精美的、有创意的网站。</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endsection
