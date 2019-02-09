@extends('public.base')

@section('title','用户注册')
@section('css')
    <link rel="stylesheet" type="text/css" href="/dist/css/account/account.css"/>
    <link rel="stylesheet" href="/dist/css/account/register.css">
    <link rel="stylesheet" type="text/css" href="/dist/css/iconfont.css">
    {{--<link rel="stylesheet" type="text/css" href="/dist/css/mobile_base.css">--}}
    <!--页面样式-->
    <link rel="stylesheet" type="text/css" href="/dist/css/me.css">
@endsection

@section('content')

    <!-- 中部内容区域 -->
    <div id="account">
        <img src="/dist/img/accountbg.png" class="accountbg" />
        <div class="wrapper-account"  style="height: 460px">
            <div class="form" style="width: 100%">
                <!--注册部分html-->
                <div class="login" style="height: 438px">
                    <p class="title" style="font-size: 20px;margin-bottom: 40px;">{{ $message }}</p>
                    <form role="form" method="POST" action="{{ route('login.login') }}" onsubmit="return emailCheck()">
                        {{ csrf_field() }}
                        <input type="hidden" name="openId" value="{{ $openId }}">
                        <input type="hidden" name="type" value="{{ $type }}" >
                        <div class="telphone inputWrapper">
                            <img src="/dist/img/user.png" class="fl" />
                            <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="姓名">
                        </div>
                        <div style="margin: 10px 0 10px 32px">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong style="color: red">{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
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
                        <div class="password inputWrapper">
                            <img src="/dist/img/password.png" class="fl" />
                            <input id="password" type="password" name="password" class="input_text_password mima_dd " placeholder="密码" style="width: 150px;">
                            <input name="" type="text" class="input_text_password mima_wz" style="display:none;width: 150px;" placeholder="密码" >
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
    function emailCheck(){
        var email = $('input[name=email]').val();
        //对电子邮件的验证
        var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
        if(!myreg.test(email)) {
            alert('提示\n\n请输入有效的E_mail！');
            return false;
        }
        return true;
    }

</script>
@endsection
