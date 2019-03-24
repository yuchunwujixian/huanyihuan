<nav class="navbar navbar-default nav-account b-shadow" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse"
              data-target="#example-navbar-collapse">
        <span class="sr-only">切换导航</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="{{route('index.index')}}" class="navbar-brand">
        <img src="/dist/img/head_logo.png" alt="Brand">
      </a>
    </div>
    <div class="collapse navbar-collapse" id="example-navbar-collapse">
      <ul class="nav navbar-nav navbar-left">
        <li @if(strpos(Route::currentRouteName(), 'index') === 0) class="active" @endif><a href="{{route('index.index')}}">首页</a></li>
        <li @if(strpos(Route::currentRouteName(), 'goods') === 0) class="active" @endif><a href="{{route('goods.index')}}">商品列表</a></li>
        <li @if(isset($current_controller_array) && $current_controller_array[0] == 'job') class="active" @endif><a href="{{route('job.index')}}">游戏圈招聘</a></li>
        <li @if(isset($current_controller_array) && $current_controller_array[0] == 'aboutus') class="active" @endif><a href="{{route('aboutus.index')}}">关于我们</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        @if (Auth::check())
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="javascript:;"><span class="glyphicon glyphicon-envelope"></span>消息</a></li>
              <li class="divider"></li>
              <li><a href="{{route('member.info.index')}}"><span class="glyphicon glyphicon-user"></span>个人中心</a></li>
              <li class="divider"></li>
              <li><a href="{{route('logout')}}"><span class="glyphicon glyphicon-log-out"></span>退出</a></li>
            </ul>
          </li>
        @else
          <li @if(strpos(Route::currentRouteName(), 'register') === 0) class="active" @endif><a href="{{route('register')}}"><span class="glyphicon glyphicon-user"></span>注册</a></li>
          <li @if(strpos(Route::currentRouteName(), 'login') === 0) class="active" @endif><a href="{{route('login')}}"><span class="glyphicon glyphicon-log-in"></span>登录</a></li>
        @endif
      </ul>
    </div>
  </div>
</nav>