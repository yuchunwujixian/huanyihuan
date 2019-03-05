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
                <div class="search col-lg-2 col-xs-2">
                    <img src="/dist/img/search.png" class="search-icon">
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
            <div class="list-wrapper">
                <div class="list">
                    <a href="pages/list/research.html">
                        <span class="list-title">本周研发品榜</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
