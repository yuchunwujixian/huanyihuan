@extends('public.base')

@section('title', $title)

@section('css')
    <link rel="stylesheet" href="/dist/css/goods.css">
@endsection


@section('content')
    <!-- 中部banner区域 -->
    <div class="container">
        <div class="row">
            <div class="col-sm-1">
                <h4>专题：</h4>
            </div>
            <div class="col-sm-11">
                <ul class="list-inline">
                    <li>Item 1</li>
                    <li>Item 2</li>
                    <li>Item 3</li>
                    <li>Item 4</li>
                </ul>
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
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <div class="display-inline font-16">
                        <a href="javascript:;" class="color-aaa">更多<i class="glyphicon glyphicon-chevron-right"></i></a>
                    </div>
                </div>
                <div class="row">
                    @foreach($v->goods as $good)
                        <div class="col-sm-6 col-md-4 col-lg-3 ">
                            <div class="thumbnail">
                                <a href="http://www.youzhan.org/" title="{{ $good->title }}" target="_blank">
                                    <img class="lazy" src="{{asset('storage/'.$good->img_url)}}" data-src="{{asset('storage/'.$good->img_url)}}" alt="{{ $good->title }}" onerror="this.src='/img/default_cover.png';this.onerror=null">
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
