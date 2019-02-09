@extends('public.base')

@section('title','我的积分')

@section('uc_here', '我的积分')

@section('css')
    <link rel="stylesheet" href="/dist/css/personal/personal.css">
    <link rel="stylesheet" href="/dist/css/personal/mypoints.css">
    <style>
        .content-nav a{
            margin-right: 52px;
        }
    </style>
@endsection

@section('content')
    @include('public.member_header')
    <div class="wrapper">
        @include('public.member_left')
        <div class="right-content">
            <form action="">
                <div class="content-nav">
                    <a class="inline-block active-nav" href="javascript:;">我的积分</a>
                    <a class="inline-block" href="{{ route('member.integral.lists') }}">积分获取</a>
                    <a class="inline-block" href="{{ route('member.integral.answer') }}">我的回答@if(Auth::user()->messages(Auth::user()->id, 'view_feedback'))<font color="red">({{ Auth::user()->messages(Auth::user()->id, 'view_feedback') }})</font>@endif</a>
                    <a class="inline-block" href="{{ route('member.integral.question') }}">我的寻求@if(Auth::user()->messages(Auth::user()->id, 'view_issue'))<font color="red">({{ Auth::user()->messages(Auth::user()->id, 'view_issue') }})</font>@endif</a>
                    <a class="inline-block" href="{{ route('member.integral.logs') }}">充值记录</a>
                </div>
                <div id="my-point-show">
                    <div class="add-my-point">
                        <span class="inline-block user-title">账号:</span><span class="user-info">{{$user->email}}</span>
                    </div>
                    <div class="add-my-point">
                        <span class="inline-block user-title">身份:</span><span class="user-info">{{$user->name}}</span>
                    </div>
                    <div class="add-my-point">
                        <span class="inline-block user-title">积分:</span><span
                                class="user-info">{{$user->integral}}</span>
                    </div>
                    <a href="{{ route('member.integral.payment') }}" id="go-recharge">去充值</a>
                    <a href="{{ route('member.integral.lists') }}"><span class="help-other">帮助其他人获得积分？</span></a>
                </div>
            </form>
        </div>
    </div>

@endsection
