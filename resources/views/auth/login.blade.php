@extends('public.base')

@section('title','关于我们')
@section('css')
    <link rel="stylesheet" href="/dist/css/account/account.css"/>
    <link rel="stylesheet" href="/dist/css/account/login.css">
    <link rel="stylesheet" type="text/css" href="/dist/css/iconfont.css">
    <link rel="stylesheet" type="text/css" href="/dist/css/me.css">
@endsection
@section('js')
    <script src="/dist/js/account/login.js"></script>
    @if (session('success'))
        <script>
            $(function(){
                alert("{{ session('success') }}")
            })
        </script>
    @endif

    <script>
        $(function(){
            $(".eyes_box").click(function(){
                if($(this).attr("data-show")==1){//明文
                    $(this).attr("data-show","2");
                    $(this).children("i").html("&#xe627;");
                    $(this).parent().children(".mima_dd").hide();
                    $(this).parent().children(".mima_wz").show();
                    $(this).parent().children(".mima_wz").val($(this).parent().children(".mima_dd").val());
                    $(this).parent().children(".mima_dd").attr('name', '');
                    $(this).parent().children(".mima_wz").attr('name', 'password');
                    return;
                }
                if($(this).attr("data-show")==2){//密文
                    $(this).attr("data-show","1");
                    $(this).children("i").html("&#xe624;");
                    $(this).parent().children(".mima_dd").show();
                    $(this).parent().children(".mima_wz").hide();
                    $(this).parent().children(".mima_dd").val($(this).parent().children(".mima_wz").val());
                    $(this).parent().children(".mima_dd").attr('name', 'password');
                    $(this).parent().children(".mima_wz").attr('name', '');
                    return;
                }
            });

        })

    </script>
@endsection

@section('content')

    <!-- 中部内容区域 -->
    <div id="account">
        <img src="/dist/img/accountbg.png" class="accountbg" />
        <div class="wrapper-account" style="height: 365px">
            <div class="accountLogo">
                <img src="/dist/img/logo_white.png"/>
                <p>北京炯米游网络科技有限公司</p>
            </div>
            <div class="form">
                <!--登录部分html-->
                <div class="login" style="height: 340px">
                    <h2 class="title">登录</h2>
                    <p class="toRegister">
                        还没账号？
                        <a href="{{route('register')}}" class="registerNow">立即注册</a>
                    </p>
                    <form role="form" method="POST" action="{{route('login')}}">
                        {{ csrf_field() }}
                        <div class="telphone inputWrapper">
                            <img class="fl" src="/dist/img/user.png"/>
                            <input id="email" type="text" name="email" placeholder="请输入邮箱账号" value="{{ old('email') }}" required autofocus>
                        </div>
                        <div style="margin: 10px 0 10px 32px">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong style="color: red">{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="inputWrapper">
                            <img src="/dist/img/password.png" class="fl" />
                            <input id="password" type="password" name="password" class="input_text_password mima_dd" placeholder="请输入密码">
                            <input name="" type="text" class="input_text_password mima_wz" style="display:none;width: 175px;" placeholder="密码" >
                            <a class="eyes_box " data-show="1" href="javascript:void(0);"><i class="icon iconfont" style="line-height: 43px;">&#xe624;</i></a> </li>
                        </div>
                        <div style="margin: 10px 0 10px 32px">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="remember">
                            <input type="checkbox" name="remember"> 记住密码
                            <a href="{{ route('forgot.password') }}" class="forgetPassword">忘记密码？</a>
                        </div>
                        <button>登 录</button>
                    </form>
                    <div class="otherWay">
                        <span>其他方式：</span>
                        <img src="/dist/img/byqq.png" style="cursor: pointer" onclick="window.location.href='{{ route('login.qq') }}'">
                        <img src="/dist/img/byweixin.png" style="cursor: pointer" onclick="window.location.href='{{ route('login.weixin') }}'">
                        <img src="/dist/img/byweibo.png" style="cursor: pointer" onclick="window.location.href='{{ route('login.weibo') }}'">
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
