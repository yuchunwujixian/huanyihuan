@extends('public.base')

@section('title','关于我们')
@section('css')
    <link rel="stylesheet" href="/dist/css/about.css">
@endsection

@section('css')
    <link rel="stylesheet" href="/dist/css/about.css">
@endsection

@section('content')
    <!--banner area-->
    <img class="about-banner" src="/dist/img/about-banner.png"/>
    <!--company profile area-->
    <div class="about-item">
        <div class="item-title">
            <img src="/dist/img/about-icon1.png"/>
            <span>企业介绍</span>
        </div>
        <div class="item-content company-profile">
            @if(isset($aboutus->description)){!! $aboutus->description !!}@else 暂无数据@endif
            <p>aaa</p>
        </div>
    </div>
    <div class="about-item">
        <div class="item-title">
            <img src="/dist/img/about-icon2.png"/>
            <span>提供服务</span>
        </div>
        <div class="item-content provide-service">
            @if($service)
                @foreach($service as $v)
                <span>{{$v}}</span>
               @endforeach
            @else
                  暂无数据
            @endif
        </div>
    </div>
    <div class="about-item">
        <div class="item-title">
            <img src="/dist/img/about-icon3.png"/>
            <span>运营游戏</span>
        </div>
        <div class="item-content run-game">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach ($games->chunk(4) as $chunks)
                    <div class="swiper-slide">
                        @foreach ($chunks as $value)
                        <div class="game-wrapper">
                            <a href="http://www.jiongmiyou.cn" class="img-wrapper" target="_blank">
                                <img src="http://www.jiongmiyou.cn{{ $value->icon }}"/>
                            </a>
                            <span class="game-title">{{ $value->title }}</span>
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
    <div class="about-item">
        <div class="item-title">
            <img src="/dist/img/about-icon4.png"/>
            <span>联系我们</span>
        </div>
        <div class="item-content contact-us">
            <div class="company-info">
                <p>公司地址：北京市东花市北里20号楼6单元501室</p>
                <br />
                <p>电话：021-15512118741</p>
                <br />
                <p>QQ：587453841</p>
            </div>
            <div class="company-info">
                <p>ADD:Room 501,Unit 6,Building 20,North Donghuoshi Residential Chongwen District BeiJing City</p>
                <br />
                <p>TEL：021-15512118741</p>
                <br />
                <p>QQ：587453841</p>
            </div>
            <div class="company-info">
                <p>公司地址：北京市东花市北里20号楼6单元501室</p>
                <br />
                <p>电话：021-15512118741</p>
                <br />
                <p>QQ：587453841</p>
            </div>
            <div class="company-info">
                <p>ADD:Room 501,Unit 6,Building 20,North Donghuoshi Residential Chongwen District BeiJing City</p>
                <br />
                <p>TEL：021-15512118741</p>
                <br />
                <p>QQ：587453841</p>
            </div>
        </div>
    </div>
    <div class="about-item last-item">
        <div class="item-title">
            <img src="/dist/img/about-icon5.png"/>
            <span>意见反馈</span>
        </div>
        <style>
            .error { margin: 5px; color: red}
        </style>
        <div class="item-content feedback">
            <div class="feedback-container clearfix">
                <form class="feedback-form" action="{{route('aboutus.feedback')}}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <textarea id="suggestInfo" name="suggestInfo" placeholder="如果您能留下宝贵建议，我们将感激不尽！"></textarea>
                    <button type="submit" id="submit" class="fr">确定</button>
                </form>
            </div>
        </div>
    </div>
@stop
@section('js')
    <!-- 引入本页js文件 -->
    <script src="/dist/js/about.js"></script>
    <script>
            $("#submit").click(function () {
                $(".feedback-form").validate({
                    errorClass: "label.error",
                    rules: {
                        suggestInfo: "required"
                    },
                    messages: {
                        suggestInfo: "请输入内容"
                    }
                });
            })

    </script>
@endsection

