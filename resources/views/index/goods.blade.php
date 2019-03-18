@extends('public.base')

@section('title', $title)

@section('css')
    <link rel="stylesheet" href="/dist/css/goods.css">
@endsection


@section('content')
    <!-- 查找商品 -->
    <div class="container goods-search">
        <div class="search-wrapper">
            <input type="text" class="col-lg-9 col-xs-9" placeholder="查找商品">
            <div class="search">
                <span class="glyphicon glyphicon-search"></span>
            </div>
        </div>
    </div>
    <!-- 搜索条件 -->
    <div class="container goods-condition">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
                        <ul class="list-inline overflow-h ele-not ele-in">
                            <li>省&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;区：</li>
                            <li class="@if(empty(app('request')->input('province')) || app('request')->input('province') == 0) active @endif link-box"
                                data-node="province" data-value="0">
                                <a href="javascript:;">全部</a>
                            </li>
                            @foreach($provinces as $k => $v)
                                <li class="@if(app('request')->input('province') == $k) active @endif link-box" data-node="province" data-value="{{ $k }}">
                                    <a href="javascript:;">{{ $v }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                        <ul class="list-inline">
                            <li><a href="javascript:;" class="area-more">更多</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
                        <ul class="list-inline overflow-h ele-not ele-in">
                            <li>市&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;区：</li>
                            <li class="@if(empty(app('request')->input('city')) || app('request')->input('city') == 0) active @endif link-box"
                                data-node="city" data-value="0">
                                <a href="javascript:;">全部</a>
                            </li>
                            @foreach($citys as $k => $v)
                                <li class="@if(app('request')->input('city') == $k) active @endif link-box" data-node="city" data-value="{{ $k }}">
                                    <a href="javascript:;">{{ $v }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                        <ul class="list-inline">
                            <li><a href="javascript:;" class="area-more">更多</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
                        <ul class="list-inline">
                            <li>商品分类：</li>
                            <li><a>最热</a></li>
                            <li><a>最热</a></li>
                            <li><a>最热</a></li>
                            <li><a>最热</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
                        <ul class="list-inline">
                            <li>专&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;题：</li>
                            <li class="active"><a>全部</a></li>
                            @foreach($topics as $v)
                                <li><a>{{ $v->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <ul class="list-inline">
                    <li>价格区间：</li>
                    <li><a>最热</a></li>
                    <li><a>最热</a></li>
                    <li><a>最热</a></li>
                    <li><a>最热</a></li>
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
            @if(count($goods))
                <div class="row same-height">
                    @foreach($goods as $good)
                        <div class="col-sm-6 col-md-4 col-lg-3 ">
                            <div class="thumbnail">
                                <a href="http://www.youzhan.org/" title="{{ $good->title }}" target="_blank">
                                    <img class="lazy" src="{{asset('storage/'.$good->img_url)}}" data-src="{{asset('storage/'.$good->img_url)}}" alt="{{ $good->title }}" onerror="this.src='/img/default_cover.png';this.onerror=null">
                                </a>
                                <div class="caption">
                                    <h3>
                                        <a href="http://www.youzhan.org/" title="Bootstrap 优站精选" target="_blank">
                                            {{ $good->title }}
                                        </a>
                                        <small><span class="text-danger">¥<strong>{{ $good->num }}</strong></span></small>
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
                <div class="page text-center">
    {{--                {{ $goods->appends($param)->links() }}--}}
                    {{ $goods->links() }}
                </div>
            @else
                <div>
                    <h3 class="text-center">暂无数据</h3>
                </div>
            @endif
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('.area-more').click(function () {
            var _this = $(this);
            if (_this.html() == '更多'){
                _this.parents('.panel-body').find('.ele-in').removeClass('overflow-h').removeClass('ele-not');
                _this.html('隐藏');
            }else{
                _this.parents('.panel-body').find('.ele-in').addClass('overflow-h').addClass('ele-not');
                _this.html('更多');
            }
        });
        var urlen = "{!! app('request')->fullUrl() !!}";
        $(document).on('click','.link-box',function(){
            var alias = $(this).attr('data-node');
            var val = $(this).attr('data-value');
            var url =decodeURIComponent(urlen);
            if(url.indexOf('page')>0) {
                var page = new RegExp( "page=([^&]*)(&|$)", "i");
                url = url.replace(page,"");
            }
            if(url.indexOf('?')>0) {
                if($.inArray(alias,['sort_default','sort_publish_time','sort_salary','sort_mate']) >= 0) {
                    var reg = new RegExp("sort_([^=]*)=([^&]*)(&|$)", "i");
                } else {
                    var reg = new RegExp( alias + "=([^&]*)(&|$)", "i");
                }
                url = url.replace(reg, "");
                window.location.href=url+"&"+alias+"="+val;
            } else {
                window.location.href=url+"?"+alias+"="+val;
            }

        });
        $(document).on('click','.pagination li a',function(event){
            event.preventDefault();
            event.stopPropagation();
            var hrefurl = $(this).attr("href");
            var reg = new RegExp("page=([^&]*)(&|$)");
            var r = hrefurl.substr(1).match(reg);
            var page =r[1];
            var url =decodeURIComponent(urlen);
            if(url.indexOf('?')>0) {
                url = url.replace(reg, "");
                window.location.href=url+"&page="+page;
            } else {
                window.location.href=url+"?page="+page;
            }
        });
        $('.ele-in').each(function (index, value) {
            overflow_deal($(value));
        });
        function overflow_deal(ele) {
            var ele_in = ele;
            if (ele_in.find('.active').length > 0 && ele_in.find('.active').offset().top != ele_in.offset().top){
                ele_in.parents('.panel-body').find('.area-more').trigger("click");
            }
        }
    </script>
@endsection
