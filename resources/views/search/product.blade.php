@extends('public.base')

@section('title','搜索详情页')

@section('css')
    <link rel="stylesheet" href="/dist/css/search/search_company.css">
    <link rel="stylesheet" href="/dist/css/search/search.css">
    <link rel="stylesheet" href="/dist/css/search/search_game.css">
    <style>
        .type-search{
            float: left;
            height: 42px;
            margin: 4px 0 0 5px;
            background-color: rgba(255, 255, 255, 0.8);
            border: none;
            width: 72px;
        }
    </style>
@endsection

@section('content')
    <!-- 中部banner区域 -->
    <div class="banner">
        <img class="banner-bg" src="/dist/img/banner.png" alt="banner">
        <form action="{{ route('search.index') }}" method="post" name="form" class="form">
            {{csrf_field()}}
            <div class="search-wrapper">
                <select class="type-search" name="type_search">
                    <option value="1">找公司</option>
                    <option value="2">找产品</option>
                    {{--<option value="3">找联系人</option>--}}
                </select>
                <input type="text" placeholder="找公司/找产品" style="width: 300px;" name="condition">
                <div class="search">
                    <img src="{{asset('dist/img/search.png')}}" class="search-icon" onclick="javascript:{document.forms['form'].submit();}">
                </div>
                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <div id="textInfo-error" class="error" style="text-align: center;margin-top: 60px;color: red">{{$error}}</div>
                    @endforeach
                @endif
            </div>
        </form>
    </div>
    <!-- 中部搜索结果区域 -->
    <div class="search-total">
        <p>共找到{{ $data->count() }}条相关信息<a href="{{ route('search.noresult') }}" style="color: #0064bc;margin-left: 5px;">没有想要的信息？点击提交需求，一键委托网站查找</a></p>
    </div>
    <div class="container">
        <div id="results">
            <div class="one-result">
                <div class="result-title">
                    游戏
                </div>
                @foreach($data as $v)
                <div class="game-title">
                    <div class="product-avatar inline-block">
                        <a href="{{ route('product.show', ['id' => $v->id]) }}" target="_target">
                            <img src="{{ $v->logo }}" />
                        </a>
                    </div>
                    <h2 class="inline-block">
                        <span>名称： {{ $v->title }}</span>
                        <span>类型： {{ $product_config['game_type'][$v->game_type_id] }}  <i>阶段： {{ $product_config['period'][$v->period_id] }}</i></span>
                        <span>合作： {{ $product_config['cooperation'][$v->cooperation_id] }}  <i>其他需求： 寻CPSl合作</i></span>
                        <span>下载地址： {{ $v->url }}</span>
                        <span>公司： {{ $v->companyInfo->title }}</span>
                    </h2>
                    <div class="stage inline-block">
                        <div class="small--icon">
                            <div class="stage-windows" @if ($v->platform_id == 4) style="display: block;" @else style="display: none;" @endif>
                                <i class="iconfont icon-windows"></i>
                            </div>
                            <div class="stage-android" @if ($v->platform_id == 1) style="display: block;" @else style="display: none;" @endif>
                                <i class="iconfont icon-android"></i>
                            </div>
                            <div class="stage-ios"  @if ($v->platform_id == 2) style="display: block;" @else style="display: none;" @endif>
                                <i class="iconfont icon-ios"></i>
                            </div>
                            <div class="stage-h5"  @if ($v->platform_id == 3) style="display: block;" @else style="display: none;" @endif>
                                <i class="iconfont icon-iconfonth5"></i>
                            </div>
                        </div>
                        <div class="small--icon-title">运行平台</div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.getElementById("description").style.height = document.getElementById("description").scrollHeight + 10 + "px";
    </script>
@endsection