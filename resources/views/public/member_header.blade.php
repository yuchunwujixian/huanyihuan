<!-- banner图 -->
<div class="banner">
    <img src="/dist/img/connect-banner.png">
</div>
<!-- 导航 -->
<style>
    .location-info {width: 75px}
</style>
<div class="location">
    <a class="location-index" href="{{route('index.index')}}">
        <i class="icon iconfont icon-home"></i><span>首页</span>
    </a>
    <i class="icon iconfont icon-icon right-arrow"></i>
    <a class="location-personal" href="{{route('member.info.index')}}">
        个人中心
    </a>
    <i class="icon iconfont icon-icon right-arrow"></i>
    <a class="location-info" href="{{route('member.info.index')}}">
        @yield('uc_here')
    </a>
</div>