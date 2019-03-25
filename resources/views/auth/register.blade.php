@extends('public.base')

@section('title', $title)
@section('css')
    <link rel="stylesheet" href="/dist/css/account/register.css">
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
                        <h3 >注册</h3>
                        <p class="panel-title margin-t-8">
                            已有账号，
                            <a href="{{ route('login') }}" class="text-blue">直接登录</a>
                        </p>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-1">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="glyphicon glyphicon-user"></i></div>
                                        <input type="text" class="form-control" placeholder="昵称" name="nickname"  value="{{ old('nickname') }}" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-10 tip-error col-sm-offset-1 text-left">
                                    @if ($errors->has('nickname'))
                                        <strong style="color: red">{{ $errors->first('nickname') }}</strong>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-1">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></div>
                                        <input type="text" class="form-control" placeholder="手机号/邮箱" name="username"  value="{{ old('username') }}" autocomplete="off">
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
                                        <input type="password" class="form-control" placeholder="密码" name="password"  value="{{ old('password') }}" autocomplete="off">
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
                                <div class="col-sm-10 col-sm-offset-1">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="验证码" name="code"  value="{{ old('code') }}">
                                        <a class="btn input-group-addon cursor back-color-blue" id="sendVerifySmsButton">获取验证码</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-10 tip-error col-sm-offset-1 text-left">
                                    @if ($errors->has('code'))
                                        <strong style="color: red">{{ $errors->first('code') }}</strong>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-1 text-left">
                                    <label>
                                        <input type="checkbox" name="allow_register" @if(old('allow_register')) checked @endif>
                                        同意<span class="form-control-static cursor">注册须知</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-1">
                                    <button type="{{ !old('allow_register')?'button':'submit' }}" class="btn btn-primary btn-block @if(!old('allow_register')) disabled @endif register-button">注册</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
@section('js')
    <script src="/dist/js/account/register.js"></script>
@endsection
