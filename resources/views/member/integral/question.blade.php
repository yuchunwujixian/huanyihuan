@extends('public.base')

@section('title','我的积分')

@section('uc_here', '积分获取')

@section('css')
    <link rel="stylesheet" href="/dist/css/personal/personal.css">
    <link rel="stylesheet" href="/dist/css/personal/getPoint.css">
    <link rel="stylesheet" href="/dist/css/personal/research.css">
    {{--<link rel="stylesheet" href="/dist/css/personal/gameproduct.css">--}}
    <link rel="stylesheet" href="/dist/css/personal/recruitment.css">
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
                    <a class="inline-block" href="{{ route('member.integral.index') }}">我的积分</a>
                    <a class="inline-block" href="{{ route('member.integral.lists') }}">积分获取</a>
                    <a class="inline-block" href="{{ route('member.integral.answer') }}">我的回答@if(Auth::user()->messages(Auth::user()->id, 'view_feedback'))<font color="red">({{ Auth::user()->messages(Auth::user()->id, 'view_feedback') }})</font>@endif</a>
                    <a class="inline-block active-nav" href="javascript:;">我的寻求@if(Auth::user()->messages(Auth::user()->id, 'view_issue'))<font color="red">({{ Auth::user()->messages(Auth::user()->id, 'view_issue') }})</font>@endif</a>
                    <a class="inline-block" href="{{ route('member.integral.logs') }}">充值记录</a>
                </div>
                <div id="cruitment-content">
                    @if($data->total())
                        @foreach($data as $value)
                            <div class="one-item" style="height: auto">
                                <div class="one-item-title">
                                    需求：{{ str_limit($value->needs, 60)}}
                                    <span style="margin-right: 0;">@if($value->status == 0) 已处理 @elseif($value->status == 1) 未处理@elseif($value->status == 2) 已拒绝 @else 已撤销 @endif</span>
                                </div>
                                <div class="one-item-content">
                                    <p>回答信息 ：@if(empty($value->feedback)) 暂无 @else <font color="red">{{str_limit($value->feedback, 60)}}</font>@endif</p>
                                    <p>评价 ：{{ empty($value->evaluate) ? "暂无" : str_limit($value->evaluate, 60) }}</p>
                                    <p>回答人信息 ：{{!empty($value->receive_user_id) ? $value->receiveUserInfo->email : "暂无"}}</p>
                                    <p>{{$value->updated_at}}</p>
                                    <div class="operation">
                                        <a href="{{ route('member.integral.view', ['id' => $value->id]) }}" style="color: #0064bc">
                                            <i class="icon iconfont icon-edit"></i>
                                            点击查看@if ($value->view_issue == 0)<font color="red">（未查看）</font>@endif
                                        </a>
                                        <input type="hidden" value="{{ $value->id }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <style>#cruitment-content{text-align: center;padding-top: 10px;}</style>
                        <span>暂无数据</span>
                    @endif
                </div>
                <div class="holder">
                   {{ $data->links('job.page') }}
                </div>
            </form>
        </div>
    </div>

@endsection
