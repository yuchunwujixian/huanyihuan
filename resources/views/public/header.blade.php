<nav class="nav-account">
  <div class="navbar-header">
    <a href="{{route('index.index')}}" class="navbar-brand">
      <img src="/dist/img/head_logo.png" alt="Brand">
    </a>
  </div>
  <style>
     .nav-account .navbar .nav-items li a {margin: 0 25px}
     .msg-count {
      position: absolute;
       right: 60px;
       top: 18px;
      width: 12px;
      height: 12px;
      border-radius: 100%;
      color: #fff;
      font-size: 10px;
      text-align: center;
      line-height: 12px;
    }
  </style>
  <div class="navbar">
    <ul class="nav-items">
      <li @if(isset($current_controller_array) && $current_controller_array[0] == 'company') class="com-nav-active" @endif><a href="{{route('company.index')}}">囧米互联</a></li>
      <li @if(isset($current_controller_array) && $current_controller_array[0] == 'publishing') class="com-nav-active" @endif><a href="{{route('publishing.product.index')}}">供需信息榜</a></li>
      <li @if(isset($current_controller_array) && $current_controller_array[0] == 'community') class="com-nav-active" @endif><a href="{{route('community.index')}}">囧米社区</a></li>
      <li @if(isset($current_controller_array) && $current_controller_array[0] == 'job') class="com-nav-active" @endif><a href="{{route('job.index')}}">游戏圈招聘</a></li>
      <li @if(isset($current_controller_array) && $current_controller_array[0] == 'aboutus') class="com-nav-active" @endif><a href="{{route('aboutus.index')}}">关于我们</a></li>
    </ul>
  </div>
  @if (Auth::check())
  <div class="user">
    <ul>
      <li><a href="{{route('member.info.index')}}">{{ str_limit(Auth::user()->name, 9) }}</a></li>
      {{--<li class="msg-coordinates"><a href="javascript:;">消息</a><span class="msg-count">2</span></li>--}}
      <li><a href="{{route('member.info.index')}}">个人中心<span class="msg-count"><font color="red">(@if(!empty(Auth::user()->companyInfo->view_status)){{ Auth::user()->messages(Auth::user()->id)+1 }}@else{{ Auth::user()->messages(Auth::user()->id) }}@endif)</font></span></a></li>
      <li><a href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">退出</a></li>
    </ul>
    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
    </form>
  </div>
  @else
    <div class="account">
      <ul class="account-items">
        <li><a href="{{route('login')}}">登录</a></li>
        <li><a class="middle-line" href="javascript:void(0);">|</a></li>
        <li><a href="{{route('register')}}">注册</a></li>
      </ul>
    </div>

  @endif
</nav>
