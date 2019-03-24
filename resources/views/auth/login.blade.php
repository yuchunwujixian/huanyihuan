@extends('public.base')

@section('title', $title)
@section('css')
    <link rel="stylesheet" href="/dist/css/account/login.css">
@endsection

@section('content')
    <!-- 中部内容区域 -->
    <div class="container" style="background: url('/dist/img/accountbg.png') no-repeat left top;background-size: cover;">
        <div class="row margin-t-44">
            <div class="col-sm-6 hidden-xs col-md-6">
                <div class="panel panel-default text-center">
                    <div class="panel-body">
                        开启美好生活
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-5 col-lg-4">
                <div class="panel panel-default text-center">
                    <div class="panel-heading">
                        <h3 >登录</h3>
                        <p class="panel-title margin-t-8">
                            还没账号？
                            <a href="{{ route('register') }}" class="text-blue">立即注册</a>
                        </p>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{route('login')}}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-1">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="glyphicon glyphicon-user"></i></div>
                                        <input type="text" class="form-control" placeholder="手机号/邮箱" name="username"  value="{{ old('username') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-10 tip-error col-sm-offset-1 text-left">
                                    @if ($errors->has('username'))
                                        <strong style="color: red">{{ $errors->first('username') }}</strong>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-1">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></div>
                                        <input type="password" class="form-control" placeholder="密码" name="password"  value="{{ old('password') }}">
                                        <div class="input-group-addon"><i class="glyphicon glyphicon-eye-close cursor password-eye"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-10 tip-error col-sm-offset-1 text-left">
                                    @if ($errors->has('password'))
                                        <strong style="color: red">{{ $errors->first('password') }}</strong>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label>
                                        <input type="checkbox" name="remember" @if(old('remember')) checked @endif>
                                        <span class="form-control-static cursor">记住密码</span>
                                    </label>
                                </div>
                                <div class="col-xs-6 padding-t-5">
                                    <a href="{{ route('forgot.password') }}" class="color-777">忘记密码？</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-1">
                                    <button type="submit" class="btn btn-primary btn-block">登录</button>
                                </div>
                            </div>
                        </form>
                        <div class="">
                            <ul class="list-inline">
                                <li class="other-login">其他方式：</li>
                                <li>
                                    <img src="/dist/img/byqq.png" class="cursor" onclick="window.location.href='{{ route('login.qq') }}'">
                                </li>
                                <li>
                                    <img src="/dist/img/byweixin.png" class="cursor" onclick="window.location.href='{{ route('login.weixin') }}'">
                                </li>
                                <li>
                                    <img src="/dist/img/byweibo.png" class="cursor" onclick="window.location.href='{{ route('login.weibo') }}'">
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
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
@endsection
