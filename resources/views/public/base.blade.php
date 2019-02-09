<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') | 北京炯米游戏</title>
    <meta name=keywords content="炯米互联,囧米互联,手机游戏行业,手游圈内人,游戏圈,游戏茶馆,上方网,上道,游戏葡萄,游戏陀螺,游资网,白鲸社区,手游那点事儿,游戏行业媒体,游戏产业网,手游新闻平台,
    手游业内通讯,手游渠道合作,找CP,找发行,找渠道,手游CP,手游发行,手游渠道,手游外包,投资商,IP授权商,H5平台,H5渠道,手机游戏开发商,天眼查">
    <meta name=description content="手游行业产品对接平台,专注于为发行以及CP研发提供优质的对接平台,关注全球移动游戏产业。提供手游排行榜,手游产品大全,手游企业,手游公司,移动游戏产品,手游行业新闻,
    行业大会,手游最新活动">
    <meta name=robots content=all>
    <meta name=googlebot content=all>
    <meta name=baiduspider content=all>
    <link rel="stylesheet" href="/dist/css/reset.css">
    <link rel="stylesheet" href="/dist/css/swiper-3.4.2.min.css" />
    <link rel="stylesheet" href="/dist/css/common.css">
    <link rel="stylesheet" href="/dist/iconfont/iconfont.css">
    <link href="https://cdn.bootcss.com/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="/dist/js/jquery-3.1.1.js"></script>
    <script src="/dist/js/jquery-validator-1.14.0.js"></script>
    <script src="/dist/js/swiper-3.4.2.jquery.min.js"></script>
    <script src="/dist/js/common.js"></script>
    <script src="https://cdn.bootcss.com/toastr.js/latest/toastr.min.js"></script>
    @yield('css')
</head>
<body>
<!--[if lt IE 9]>
<script src="/dist/js/html5shiv.min.js"></script>
<![endif]-->
<!-- 顶部导航栏 -->
@include('public.header')

<!-- 中部内容区域 -->
@yield('content')

<!-- 页面底部 -->
@include('public.footer')
@yield('js')

{!! Toastr::render() !!}
<script>
    //定位提示信息位置为头部居中
    toastr.options = {"positionClass":"toast-top-center"};
</script>
</body>
</html>