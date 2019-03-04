<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') | {{ config('config_base.site_name') }}</title>
    <meta name=keywords content="{{ $base_config?$base_config->meta_keywords:'' }}">
    <meta name=description content="{{ $base_config?$base_config->meta_description:'' }}">
    <meta name=robots content=all>
    <meta name=googlebot content=all>
    <meta name=baiduspider content=all>
    <link rel="stylesheet" href="/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/plugins/bootstrap-swiper/swiper-3.4.2.min.css" />
    <link rel="stylesheet" href="/dist/iconfont/iconfont.css">
    <link rel="stylesheet" href="/plugins/toastr/toastr.min.css" >
    <link rel="stylesheet" href="/dist/css/common.css">
    @yield('css')
<!--[if lt IE 9]>
    <script src="/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="/libs/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- 提示消息 -->
@include('public.tips')
<!-- 顶部导航栏 -->
@include('public.header')

<!-- 中部内容区域 -->
@yield('content')

<!-- 页面底部 -->
@include('public.footer')

<script src="/js/jquery-2.0.0/jquery.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="/dist/js/jquery-validator-1.14.0.js"></script>
<script src="/plugins/bootstrap-swiper/swiper-3.4.2.jquery.min.js"></script>
<script src="/plugins/toastr/toastr.min.js"></script>
@yield('js')

{!! Toastr::render() !!}
<script>
    //定位提示信息位置为头部居中
    toastr.options = {"positionClass":"toast-top-center"};
    //提示消息关闭
    $('.tips-del').click(function () {
        $(this).parent().remove()
    })
</script>
</body>
</html>