@extends('public.base')

@section('title', $title)

@section('css')
    <link rel="stylesheet" href="/dist/css/index.css">
@endsection

@section('content')
    <!-- 中部banner区域 -->
    <div class="banner b-shadow">
        @include('public.banner')
        <div class="container">
            <div class="search-wrapper">
                <input type="text" class="col-lg-9 col-xs-9" placeholder="查找商品">
                <div class="search search-goods">
                    <span class="glyphicon glyphicon-search"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="text-center margin-t-44 margin-b-40">
            <h2 class="font-24">从此开启美好生活</h2>
            <p class="font-14 color-aaa margin-t-8">Start a good life from now on</p>
        </div>
    </div>
    <!-- 中部周榜区域 -->
    <div class="container">
        <!-- 专题 -->
        @foreach($topics as $v)
            <div class="row font-22 margin-b-10 sm-center">
                <div class="display-inline">
                    {{ $v->title }}
                </div>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div class="display-inline font-16">
                    <a href="javascript:;" class="color-aaa">更多<i class="glyphicon glyphicon-chevron-right"></i></a>
                </div>
            </div>
            <div class="row same-height">
                @foreach($v->goods as $good)
                    <div class="col-sm-6 col-md-4 col-lg-3 margin-t-8">
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
                                    <div class="display-inline"><a href="javascript:;">{{ $good->user->nickname }}</a></div>
                                    <div class="display-inline fr">浏览：{{ $good->view_count }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
@section('js')
    <script>
        $('.search-goods').click(function () {
            var _this = $(this);
            var keyword = _this.prev().val();
            if (!keyword){
                toastr.error('商品名称不能为空');
                return ;
            }
            window.location.href = '{{ route('goods.index') }}' + '?keyword='+keyword;
        })
    </script>
@endsection
