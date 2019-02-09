@extends('public.base')

@section('title','我的积分')

@section('uc_here', '充值记录')

@section('css')
    <link rel="stylesheet" href="/dist/css/personal/personal.css">
    <link rel="stylesheet" href="/dist/css/personal/getPoint.css">
    <style>
        .one-item-show span, .one-title-show span{
            width: 155px;
        }
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
                    <a class="inline-block" href="{{ route('member.integral.index') }}">我的积分</a>
                    <a class="inline-block" href="{{ route('member.integral.lists') }}">积分获取</a>
                    <a class="inline-block" href="{{ route('member.integral.answer') }}">我的回答@if(Auth::user()->messages(Auth::user()->id, 'view_feedback'))<font color="red">({{ Auth::user()->messages(Auth::user()->id, 'view_feedback') }})</font>@endif</a>
                    <a class="inline-block" href="{{ route('member.integral.question') }}">我的寻求@if(Auth::user()->messages(Auth::user()->id, 'view_issue'))<font color="red">({{ Auth::user()->messages(Auth::user()->id, 'view_issue') }})</font>@endif</a>
                    <a class="inline-block active-nav" href="javascript:;">充值记录</a>
                </div>
                <div id="my-point-show">
                    <div class="one-title-show" style="width: 627px;">
                        <span>充值金额（元）</span>
                        <span>充值方式</span>
                        <span>充值状态</span>
                        <span>充值时间</span>
                    </div>
                    @if($data->count())
                        @foreach($data as $v)
                            <div class="one-item-show" style="width: 627px;">
                                <span> {{ $v->account }}</span>
                                <span> {{ $v->payment }}</span>
                                <span>@if($v->status == 0) <font color="red">失败</font> @else <font color="#3d7dc5">成功</font>  @endif</span>
                                <span>{{$v->updated_at}}</span>
                            </div>
                        @endforeach
                        @else
                        <div class="one-item-show" style="width: 627px;text-align: center;padding-bottom: 10px">
                            暂无数据
                        </div>
                    @endif
                </div>
                <div class="holder">
                   {{ $data->links('job.page') }}
                </div>
            </form>
        </div>
    </div>

@endsection
