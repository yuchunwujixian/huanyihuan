@extends('public.base')

@section('title','产品详情页')

@section('css')
    <!-- 引入本页样式 -->
    <link rel="stylesheet" href="/dist/css/game/game.css">
@endsection

@section('content')
    <!-- 中部内容区域 -->
    @if($data)
    <div class="game-wrapper">
        <div class="game-item">
            <div class="game-info">
                <p class="item-title">游戏</p>
                <div class="product-wrapper" style="background: none;height: 100% ">
                    <style>.product-wrapper .product-img-wrapper img {width: 240px; height: 240px}</style>
                    <div class="product-img-wrapper" style="width: 240px; height: 240px">
                        <img src="{{ $data->logo }}">
                    </div>
                    <style>.product-wrapper .product-info p {line-height: 35px}</style>
                    <div class="product-info">
                        <p>
                            <span>游戏名称：</span>
                            <span>《{{ $data->title }}》</span>
                        </p>
                        <p>
                            <span>平&nbsp;&nbsp;&nbsp;&nbsp;台：</span>
                            <span>
                                @foreach(explode(',', $data->platform_id) as $key => $value)
                                    {{$product_config['platform'][$value]}}/
                                @endforeach
                            </span>
                        </p>
                        <p>
                            <span>类&nbsp;&nbsp;&nbsp;&nbsp;型：</span>
                            <span>{{ $product_config['game_type'][$data->game_type_id] }}</span>
                        </p>
                        <p>
                            <span>公&nbsp;&nbsp;&nbsp;&nbsp;司：</span>
                            <span>{{ $data->companyInfo->title }}</span>
                        </p>
                        <p>
                            <span>联系人&nbsp;&nbsp;：</span>
                            <span>{{ $data->contact }}</span>
                        </p>
                        <p>
                            <span>下载地址：</span>
                            <span><a href="{{ $data->url }}" target="_blank" style="color: blue">{{ $data->url }}</a></span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="game-goal">
                <p class="item-title">需求目标</p>
                <div class="goal-wrapper">
                    <textarea  name="needs" id="needs"  onpropertychange="this.style.height = this.scrollHeight + 'px';" oninput="this.style.height = this.scrollHeight + 'px';" style="width: 95%;overflow-x: hidden;overflow-y: hidden;resize: none;border: 0;background-color: white" disabled>{{ $data->needs }}</textarea>
                </div>
            </div>
            {{--<div class="game-cooperation">--}}
                {{--<p class="item-title">合作区域及备注</p>--}}
                {{--<div class="business-nav">--}}
                    {{--<ul>--}}
                        {{--<li class="b-nav-active b-nav-item">产品找外包</li>--}}
                        {{--<li class="b-nav-item">产品找发行</li>--}}
                        {{--<li class="b-nav-item">产品找渠道</li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
                {{--<div class="business-requirement">--}}
                    {{--<div>--}}
                        {{--<span>公司</span>--}}
                        {{--<span>联系人</span>--}}
                        {{--<span>我们在找</span>--}}
                        {{--<span>合作方式</span>--}}
                        {{--<span>发行区域</span>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<span>北京炯米科技有限公司</span>--}}
                        {{--<span>王震</span>--}}
                        {{--<span>二次元、休闲养成、各种题材网游</span>--}}
                        {{--<span>独代、联运、投资</span>--}}
                        {{--<span>国内</span>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<span>北京炯米科技有限公司</span>--}}
                        {{--<span>王震</span>--}}
                        {{--<span>二次元、休闲养成、各种题材网游</span>--}}
                        {{--<span>独代、联运、投资</span>--}}
                        {{--<span>国内</span>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<span>北京炯米科技有限公司</span>--}}
                        {{--<span>王震</span>--}}
                        {{--<span>二次元、休闲养成、各种题材网游</span>--}}
                        {{--<span>独代、联运、投资</span>--}}
                        {{--<span>国内</span>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<span>北京炯米科技有限公司</span>--}}
                        {{--<span>王震</span>--}}
                        {{--<span>二次元、休闲养成、各种题材网游</span>--}}
                        {{--<span>独代、联运、投资</span>--}}
                        {{--<span>国内</span>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="business-requirement" style="display: none;">--}}
                    {{--<div>--}}
                        {{--<span>公司</span>--}}
                        {{--<span>联系人</span>--}}
                        {{--<span>我们在找</span>--}}
                        {{--<span>合作方式</span>--}}
                        {{--<span>发行区域</span>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<span>北京炯米科技有限公司</span>--}}
                        {{--<span>王震</span>--}}
                        {{--<span>投资</span>--}}
                        {{--<span>独代</span>--}}
                        {{--<span>上海</span>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<span>北京炯米科技有限公司</span>--}}
                        {{--<span>王震</span>--}}
                        {{--<span>投资</span>--}}
                        {{--<span>独代</span>--}}
                        {{--<span>上海</span>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<span>北京炯米科技有限公司</span>--}}
                        {{--<span>王震</span>--}}
                        {{--<span>投资</span>--}}
                        {{--<span>独代</span>--}}
                        {{--<span>上海</span>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="business-requirement" style="display: none;">--}}
                    {{--<div>--}}
                        {{--<span>公司</span>--}}
                        {{--<span>联系人</span>--}}
                        {{--<span>我们在找</span>--}}
                        {{--<span>合作方式</span>--}}
                        {{--<span>发行区域</span>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<span>北京炯米科技有限公司</span>--}}
                        {{--<span>王震</span>--}}
                        {{--<span>投资</span>--}}
                        {{--<span>独代</span>--}}
                        {{--<span>国内</span>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<span>北京炯米科技有限公司</span>--}}
                        {{--<span>王震</span>--}}
                        {{--<span>投资</span>--}}
                        {{--<span>独代</span>--}}
                        {{--<span>国内</span>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            <div class="game-contact">
                <p class="item-title">联系人</p>
                <ul>
                    <li class="research contact-active">研发方</li>
                    <li class="operate">运营方</li>
                </ul>
                <div class="research-wrapper">
                    <div class="row-title">
                        <span>姓名</span>
                        <span>职务</span>
                        <span>负责区域</span>
                        <span>负责事宜</span>
                        <span>联系方式</span>
                    </div>
                    @foreach($data->productPersons->where('type', 1) as $person)
                    <div class="row-content">
                        <span>{{$person->name}}</span>
                        <span>{{$person->job}}</span>
                        <span> {{$person->area}}</span>
                        <span> {{$person->charge}}</span>
                        <span> {{$product_config['tel_type'][$person->tel_type]}}: {{$person->tel_phone}}</span>
                    </div>
                    @endforeach
                </div>
                <div class="operate-wrapper" style="display: none">
                    <div class="row-title">
                        <span>姓名</span>
                        <span>职务</span>
                        <span>负责区域</span>
                        <span>负责事宜</span>
                        <span>联系方式</span>
                    </div>
                    @foreach($data->productPersons->where('type', 0) as $person)
                        <div class="row-content">
                            <span>{{$person->name}}</span>
                            <span>{{$person->job}}</span>
                            <span> {{$person->area}}</span>
                            <span> {{$person->charge}}</span>
                            <span> {{$product_config['tel_type'][$person->tel_type]}}: {{$person->tel_phone}}</span>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="game-introduce">
                <p class="item-title">游戏介绍</p>
                <div class="introduce-wrapper">
                    <textarea  name="description" id="description"  onpropertychange="this.style.height = this.scrollHeight + 'px';" oninput="this.style.height = this.scrollHeight + 'px';" style="width: 95%;overflow-x: hidden;overflow-y: hidden;resize: none;border: 0;background-color: white" disabled>{{ $data->description }}</textarea>
                </div>
            </div>
            <div class="game-screenshot">
                <p class="item-title">游戏截图</p>
                <div class="screenshot-wrapper">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach ($data->productPhotos as $value)
                            <div class="swiper-slide">
                                <a href="javascript:void(0);" class="img-wrapper">
                                    <img src="{{ $value->url }}"/>
                                </a>
                            </div>
                            @endforeach
                        </div>
                        <!-- 导航按钮 -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
        <div style="height:400px;text-align: center;padding-top: 40px;"> 对不起，您要找的信息不存在，请从新查找！！！</div>
    @endif
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            var mySwiper = new Swiper ('.swiper-container', {
                direction: 'horizontal',
                loop: true,
                // 如果需要前进后退按钮
                nextButton: '.swiper-button-next',
                prevButton: '.swiper-button-prev'
            });
            $('.research').on('click', function() {
                $(this).addClass('contact-active').siblings().removeClass('contact-active')
                $('.research-wrapper').show().siblings('.operate-wrapper').hide()
            })
            $('.operate').on('click', function() {
                $(this).addClass('contact-active').siblings().removeClass('contact-active')
                $('.research-wrapper').hide().siblings('.operate-wrapper').show()
            })

            $('.b-nav-item').each(function(i) {
                $(this).on('click', function() {
                    $(this).siblings().removeClass('b-nav-active')
                    $(this).addClass('b-nav-active')
                    $('.business-requirement').hide()
                    $($('.business-requirement')[i]).show()
                })
            })
        })

        document.getElementById("needs").style.height = document.getElementById("needs").scrollHeight + 10 + "px";
        document.getElementById("description").style.height = document.getElementById("description").scrollHeight + 10 + "px";
    </script>
@endsection

