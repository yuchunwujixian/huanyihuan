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
        <div class="banner-bg">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="/dist/img/banner.png" alt="banner">
                    </div>
                    <div class="swiper-slide">
                        <img src="/dist/img/about-banner.png" alt="banner">
                    </div>
                    <div class="swiper-slide">
                        <img src="/dist/img/recruit-banner.png" alt="banner">
                    </div>
                </div>
            </div>
        </div>
        <div class="search-wrapper">
            <input type="text" placeholder="找公司/找产品/找联系人">
            <div class="search">
                <img src="/dist/img/search.png" class="search-icon">
            </div>
        </div>
    </div>
    <!-- 中部周榜区域 -->
    <div class="week-list">
        <div class="week-list-head">
            <h2 class="week-list-title">从此开启智联生活</h2>
            <p class="week-list-comment">From now on open at life</p>
        </div>
        <div class="list-wrapper">
            <div class="list list1">
                <a href="pages/list/research.html">
                    <span class="list-title">本周研发品榜</span>
                </a>
                <ul>
                    <li>
                        <a href="pages/list/research.html" class="text" style="display: none;">
                            <!-- <span></span> -->
                            <p class="find">吾王-单机-Arpg寻独代-港澳台--（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/research.html" class="text">
                            <!-- <span></span> -->
                            <p class="find">吾王-单机-Arpg寻独代-港澳台--（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/research.html" class="text">
                            <!-- <span></span> -->
                            <p class="find">吾王-单机-Arpg寻独代-港澳台--（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/research.html" class="text">
                            <!-- <span></span> -->
                            <p class="find">吾王-单机-Arpg寻独代-港澳台--（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/research.html" class="text">
                            <!-- <span></span> -->
                            <p class="find">吾王-单机-Arpg寻独代-港澳台--（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/research.html" class="text">
                            <!-- <span></span> -->
                            <p class="find">吾王-单机-Arpg寻独代-港澳台--（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/research.html" class="text">
                            <!-- <span></span> -->
                            <p class="find">吾王-单机-Arpg寻独代-港澳台--（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/research.html" class="text">
                            <!-- <span></span> -->
                            <p class="find">吾王-单机-Arpg寻独代-港澳台--（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/research.html" class="text">
                            <!-- <span></span> -->
                            <p class="find">吾王-单机-Arpg寻独代-港澳台--（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/research.html" class="text">
                            <!-- <span></span> -->
                            <p class="find">吾王-单机-Arpg寻独代-港澳台--（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/research.html" class="text">
                            <!-- <span></span> -->
                            <p class="find">吾王-单机-Arpg寻独代-港澳台--（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/research.html" class="text">
                            <!-- <span></span> -->
                            <p class="find">吾王-单机-Arpg寻独代-港澳台--（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/research.html" class="text">
                            <!-- <span></span> -->
                            <p class="find">吾王-单机-Arpg寻独代-港澳台--（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/research.html" class="text">
                            <!-- <span></span> -->
                            <p class="find">吾王-单机-Arpg寻独代-港澳台--（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/research.html" class="text">
                            <!-- <span></span> -->
                            <p class="find">吾王-单机-Arpg寻独代-港澳台--（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/research.html" class="text">
                            <!-- <span></span> -->
                            <p class="find">吾王-单机-Arpg寻独代-港澳台--（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/research.html" class="text">
                            <!-- <span></span> -->
                            <p class="find">吾王-单机-Arpg寻独代-港澳台--（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/research.html" class="text">
                            <!-- <span></span> -->
                            <p class="find">吾王-单机-Arpg寻独代-港澳台--（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/research.html" class="text">
                            <!-- <span></span> -->
                            <p class="find">吾王-单机-Arpg寻独代-港澳台--（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/research.html" class="text">
                            <!-- <span></span> -->
                            <p class="find">吾王-单机-Arpg寻独代-港澳台--（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="list list2">
                <a href="pages/list/release.html">
                    <span class="list-title">本周发行需求榜</span>
                </a>
                <ul>
                    <li>
                        <a href="pages/list/release.html" class="text" style="display: none;">
                            <p class="find">寻二次元、休闲养成、各种题材网游-独代-欧美-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/release.html" class="text">
                            <p class="find">寻二次元、休闲养成、各种题材网游-独代-欧美-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/release.html" class="text">
                            <p class="find">寻二次元、休闲养成、各种题材网游-独代-欧美-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/release.html" class="text">
                            <p class="find">寻二次元、休闲养成、各种题材网游-独代-欧美-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/release.html" class="text">
                            <p class="find">寻二次元、休闲养成、各种题材网游-独代-欧美-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/release.html" class="text">
                            <p class="find">寻二次元、休闲养成、各种题材网游-独代-欧美-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/release.html" class="text">
                            <p class="find">寻二次元、休闲养成、各种题材网游-独代-欧美-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/release.html" class="text">
                            <p class="find">寻二次元、休闲养成、各种题材网游-独代-欧美-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/release.html" class="text">
                            <p class="find">寻二次元、休闲养成、各种题材网游-独代-欧美-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/release.html" class="text">
                            <p class="find">寻二次元、休闲养成、各种题材网游-独代-欧美-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/release.html" class="text">
                            <p class="find">寻二次元、休闲养成、各种题材网游-独代-欧美-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/release.html" class="text">
                            <p class="find">寻二次元、休闲养成、各种题材网游-独代-欧美-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/release.html" class="text">
                            <p class="find">寻二次元、休闲养成、各种题材网游-独代-欧美-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/release.html" class="text">
                            <p class="find">寻二次元、休闲养成、各种题材网游-独代-欧美-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/release.html" class="text">
                            <p class="find">寻二次元、休闲养成、各种题材网游-独代-欧美-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/release.html" class="text">
                            <p class="find">寻二次元、休闲养成、各种题材网游-独代-欧美-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/release.html" class="text">
                            <p class="find">寻二次元、休闲养成、各种题材网游-独代-欧美-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/release.html" class="text">
                            <p class="find">寻二次元、休闲养成、各种题材网游-独代-欧美-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/release.html" class="text">
                            <p class="find">寻二次元、休闲养成、各种题材网游-独代-欧美-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/release.html" class="text">
                            <p class="find">寻二次元、休闲养成、各种题材网游-独代-欧美-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="list list3">
                <a href="pages/list/channel.html">
                    <span class="list-title">本周渠道需求榜</span>
                </a>
                <ul>
                    <li>
                        <a href="pages/list/channel.html" class="text" style="display: none;">
                            <p class="find">囧米应用商店 -寻ARPG类网游 -联运-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/channel.html" class="text">
                            <p class="find">囧米应用商店 -寻ARPG类网游 -联运-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/channel.html" class="text">
                            <p class="find">囧米应用商店 -寻ARPG类网游 -联运-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/channel.html" class="text">
                            <p class="find">囧米应用商店 -寻ARPG类网游 -联运-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/channel.html" class="text">
                            <p class="find">囧米应用商店 -寻ARPG类网游 -联运-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/channel.html" class="text">
                            <p class="find">囧米应用商店 -寻ARPG类网游 -联运-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/channel.html" class="text">
                            <p class="find">囧米应用商店 -寻ARPG类网游 -联运-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/channel.html" class="text">
                            <p class="find">囧米应用商店 -寻ARPG类网游 -联运-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/channel.html" class="text">
                            <p class="find">囧米应用商店 -寻ARPG类网游 -联运-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/channel.html" class="text">
                            <p class="find">囧米应用商店 -寻ARPG类网游 -联运-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/channel.html" class="text">
                            <p class="find">囧米应用商店 -寻ARPG类网游 -联运-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/channel.html" class="text">
                            <p class="find">囧米应用商店 -寻ARPG类网游 -联运-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/channel.html" class="text">
                            <p class="find">囧米应用商店 -寻ARPG类网游 -联运-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/channel.html" class="text">
                            <p class="find">囧米应用商店 -寻ARPG类网游 -联运-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/channel.html" class="text">
                            <p class="find">囧米应用商店 -寻ARPG类网游 -联运-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/channel.html" class="text">
                            <p class="find">囧米应用商店 -寻ARPG类网游 -联运-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/channel.html" class="text">
                            <p class="find">囧米应用商店 -寻ARPG类网游 -联运-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/channel.html" class="text">
                            <p class="find">囧米应用商店 -寻ARPG类网游 -联运-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/channel.html" class="text">
                            <p class="find">囧米应用商店 -寻ARPG类网游 -联运-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/channel.html" class="text">
                            <p class="find">囧米应用商店 -寻ARPG类网游 -联运-（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="list list4">
                <a href="pages/list/outsource_need.html">
                    <span class="list-title">本周外包需求榜</span>
                </a>
                <ul>
                    <li>
                        <a href="pages/list/outsource_need.html" class="text" style="display: none;">
                            <p class="find">寻 音乐外包服务提供商  -（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/outsource_need.html" class="text">
                            <p class="find">寻 音乐外包服务提供商  -（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/outsource_need.html" class="text">
                            <p class="find">寻 音乐外包服务提供商  -（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/outsource_need.html" class="text">
                            <p class="find">寻 音乐外包服务提供商  -（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/outsource_need.html" class="text">
                            <p class="find">寻 音乐外包服务提供商  -（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/outsource_need.html" class="text">
                            <p class="find">寻 音乐外包服务提供商  -（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/outsource_need.html" class="text">
                            <p class="find">寻 音乐外包服务提供商  -（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/outsource_need.html" class="text">
                            <p class="find">寻 音乐外包服务提供商  -（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/outsource_need.html" class="text">
                            <p class="find">寻 音乐外包服务提供商  -（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/outsource_need.html" class="text">
                            <p class="find">寻 音乐外包服务提供商  -（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/outsource_need.html" class="text">
                            <p class="find">寻 音乐外包服务提供商  -（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/outsource_need.html" class="text">
                            <p class="find">寻 音乐外包服务提供商  -（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/outsource_need.html" class="text">
                            <p class="find">寻 音乐外包服务提供商  -（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/outsource_need.html" class="text">
                            <p class="find">寻 音乐外包服务提供商  -（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/outsource_need.html" class="text">
                            <p class="find">寻 音乐外包服务提供商  -（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/outsource_need.html" class="text">
                            <p class="find">寻 音乐外包服务提供商  -（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/outsource_need.html" class="text">
                            <p class="find">寻 音乐外包服务提供商  -（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/outsource_need.html" class="text">
                            <p class="find">寻 音乐外包服务提供商  -（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/outsource_need.html" class="text">
                            <p class="find">寻 音乐外包服务提供商  -（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pages/list/outsource_need.html" class="text">
                            <p class="find">寻 音乐外包服务提供商  -（北京炯米游网络科技有限公司）</p>
                        </a>
                        <a href="pages/list/research.html" class="detail" style="display: none;">
                            <img src="/dist/img/img-game1.png" alt="">
                            <div class="detail-info">
                                <p class="info1">新剑与魔法-网游-RPG</p>
                                <p class="info2">寻独代-港澳台</p>
                                <p class="info3">北京炯米游网络科技有限公司</p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
