<!-- 中部banner区域 -->
<div class="banner b-shadow">
    @include('public.banner')
</div>

<div class="container">
    <!-- 导航 -->
    <ol class="breadcrumb">
        <li>
            <a href="{{route('index.index')}}">
                <i class="glyphicon glyphicon-home"></i><span>首页</span>
            </a>
        </li>
        <li>
            <a href="{{route('member.info.index')}}">
                个人中心
            </a>
        </li>
        <li>
            <span>
                @yield('uc_here')
            </span>
        </li>
    </ol>
</div>