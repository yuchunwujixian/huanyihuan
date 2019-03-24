@extends('public.base')

@section('title','找回密码')
@section('css')
    <link rel="stylesheet" type="text/css" href="/dist/css/account/account.css"/>
    <link rel="stylesheet" href="/dist/css/account/register.css">
@endsection

@section('content')

    <!-- 中部内容区域 -->
    <div id="account">
        <img src="/dist/img/accountbg.png" class="accountbg" />
        <div class="wrapper-account"  style="height: 352px">
            <div class="accountLogo">
                <img src="/dist/img/logo_white.png"/>
                <p>北京炯米游网络科技有限公司</p>
            </div>
            <div class="form">
                <!--注册部分html-->
                <div class="login" style="height: 330px">
                    <h2 class="title">找回密码</h2>
                    <p class="toRegister">
                        请输入你的邮箱账号，我们将发送验证码到你的账号
                    </p>
                    <form role="form" method="POST" action="{{ route('forgot.password.reset') }}">
                        {{ csrf_field() }}

                        <div class="telphone inputWrapper">
                            <img src="/dist/img/user.png" class="fl" />
                            <input id="email" type="text" name="email" value="{{ old('email') }}" placeholder="请输入邮箱账号">
                        </div>
                        <div style="margin: 10px 0 10px 32px">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong style="color: red">{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="idcode">
                            <input type="text" placeholder="请输入验证码" name="code" value="{{ old('code') }}" >
                            <span id="sendVerifySmsButton">获取验证码</span>
                        </div>

                        @if ($errors->has('code'))
                            <span class="help-block" style="margin: 10px 0 10px 32px;color: red">
                                    <strong>{{ $errors->first('code') }}</strong>
                                </span>
                        @endif
                        @if (session('code'))
                            <span class="help-block" style="margin: 10px 0 10px 32px;color: red">
                                <strong>{{ session('code') }}</strong>
                             </span>
                        @endif
                        <div class="password inputWrapper">
                            <img src="/dist/img/password.png" class="fl" />
                            <input id="password" type="password" name="password" class="input_text_password mima_dd " placeholder="请输入新的密码" style="width: 150px;">
                            <input name="" type="text" class="input_text_password mima_wz" style="display:none;width: 150px;" placeholder="请输入新的密码" >
                            <a class="eyes_box " data-show="1" href="javascript:void(0);"><i class="icon iconfont" style="line-height: 43px;">&#xe624;</i></a> </li>
                            {{--<img class="fr" src="/dist/img/notshow.png">--}}
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <button class="getPasswordBtn">确定</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
<script>
    $(function(){
        //点击获取验证码进入倒计时
        var isTiming = true;
        $('#sendVerifySmsButton').on('click', function() {
            var email = $('input[name=email]').val();
            var temp = document.getElementById("text1");
            //对电子邮件的验证
            var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
            if(!myreg.test(email)) {
                alert('提示\n\n请输入有效的E_mail！');
                return false;
                }
            $(this).css('background-color', '#c7c7c7');
            if (isTiming) {
                $.ajax({
                    url     : "{{ route('forgot.password.send') }}",
                    type    : 'POST',
                    data    : {'email' : email, '_token' : "{{ csrf_token() }}"},
                    success : function (data) {
                        if (data.code == 0) {
                            alert(data.message)
                        } else {
                            alert(data.message)
                        }
                    }
                });
                //isTiming = true
                isTiming = false;
                //进入倒计时
                var second = 60;
                var that = this;
                $(that).text(second);
                var timer = setInterval(function() {
                    second--;
                    if (second > 0) {
                        $(that).text(second);
                    } else {
                        clearInterval(timer);
                        //isTiming = false
                        isTiming = true;
                        $(that).text("获取验证码");
                        $('.idcode span').css('background-color', '#0063bc');
                    };
                },1000);
            } else {
                //正在计时，返回
                return;
            };
        });
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
