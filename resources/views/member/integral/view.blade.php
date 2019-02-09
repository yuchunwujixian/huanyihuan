@extends('public.base')

@section('title','我的积分')

@section('uc_here', '帮助详情')

@section('css')
    <link rel="stylesheet" href="/dist/css/personal/personal.css">
    <link rel="stylesheet" href="/dist/css/personal/getPoint.css">
    <style>
        .left-form {
            width: 17%;
            display: inline-block;
            vertical-align: top;
            color: #373737;
        }
        .form-item {
            line-height: 30px;
            margin: 15px 0px 5px 0px;
        }
        .right-form {
            width: 81%;
            display: inline-block;
            vertical-align: top;
            position: relative;
        }
        .right-form textarea {
            width: 100%;
            text-indent: 32px;
            height: 82px;
            line-height: 30px;
            color: #686868;
            background-color: #ededed;
            padding: 0;
            border: 0;
            outline: 0;
            resize: none;
        }
        .feedback-form {
            width: 81%;
            display: inline-block;
            vertical-align: top;
            position: relative;
        }
        .feedback-form textarea {
            width: 100%;
            text-indent: 32px;
            height: 82px;
            line-height: 30px;
            color: #686868;
            padding: 0;
            resize: none;
        }
        .save-btn {
            display: block;
            margin: 54px auto 0;
            width: 160px;
            height: 32px;
            line-height: 32px;
            text-align: center;
            background-color: #0269b8;
            color: #fff;
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
            <form method="post" class="feedback" name="form" action="">
                <div class="content-nav">
                    <a class="inline-block" href="{{ route('member.integral.index') }}">我的积分</a>
                    <a class="inline-block" href="{{ route('member.integral.lists') }}">积分获取</a>
                    <a class="inline-block" href="{{ route('member.integral.answer') }}">我的回答@if(Auth::user()->messages(Auth::user()->id, 'view_feedback'))<font color="red">({{ Auth::user()->messages(Auth::user()->id, 'view_feedback') }})</font>@endif</a>
                    <a class="inline-block active-nav" href="{{ route('member.integral.question') }}">我的寻求@if(Auth::user()->messages(Auth::user()->id, 'view_issue'))<font color="red">({{ Auth::user()->messages(Auth::user()->id, 'view_issue') }})</font>@endif</a>
                    <a class="inline-block" href="{{ route('member.integral.logs') }}">充值记录</a>
                </div>
                <div id="my-point-show">
                    @if($data)
                        {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="form-item">
                            <div class="left-form">
                                反馈人账户：
                            </div>
                            <div class="right-form">
                                @if($data->receive_user_id)
                               {{ $data->receiveUserInfo->email }}
                                    @else
                                暂无
                                    @endif
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="left-form">
                                发布时间：
                            </div>
                            <div class="right-form">
                                {{ $data->created_at }}
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="left-form">
                                需求：
                            </div>
                            <div class="right-form">
                                <textarea>{{ $data->needs }}</textarea>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="left-form">
                                反馈：
                            </div>
                            <div class="right-form">
                                @if($data->feedback)
                                    <textarea> {{ $data->feedback }}</textarea>
                                @else
                                    暂无
                                @endif
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="left-form">
                                评价：
                            </div>
                            @if (!empty($data->evaluate))
                            <div  class="right-form">
                                <textarea>{{ $data->evaluate }}</textarea>
                            </div>
                            @else
                                <div  class="feedback-form">
                                    <textarea name="evaluate" placeholder="请输入评价信息">谢谢您的回答</textarea>
                                </div>
                            @endif
                        </div>
                        @if($data->feedback)
                            @if($data->status == 1)
                                <div style="text-align: center">
                                    <input type="button" style="display: inline-block" value="拒绝" class="save-btn" onclick="refuse()">
                                    <input type="button" style="display: inline-block" value="接受" class="save-btn" onclick="sub();">
                                    <input type="hidden" name="act" value="submit">
                                </div>
                                    @elseif ($data->status == 0)
                                <input type="button" value="已完成" class="save-btn" style="background-color: #686868">
                            @else
                                <input type="button" value="已拒绝" class="save-btn" style="background-color: #686868">
                            @endif
                        @else
                            @if($data->status == 1)
                            <input type="button" value="撤销帮助" class="save-btn" onclick="cancel()">
                            <input type="hidden" name="act" value="cancel">
                            @else
                                <input type="button" value="已撤销" class="save-btn" style="background-color: #686868">
                            @endif
                        @endif
                        @else
                        <div class="one-item-show" style="width: 627px;text-align: center;padding-bottom: 10px">
                            暂无数据
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>

@endsection
@section('js')
    <script>
        $().ready(function () {
            // 在键盘按下并释放及提交后验证提交表单
            $(".feedback").validate({
                rules: {
                    feedback: "required"
                },
                messages: {
                    feedback: "请输入信息"
                }
            });
        });
        function sub(){
            document.forms['form'].action="{{ route('member.integral.sure') }}";
            document.forms['form'].submit();
        }
        function refuse(){
            document.forms['form'].action="{{ route('member.integral.refuse') }}";
            document.forms['form'].submit();
        }
        function cancel(){
            document.forms['form'].action="{{ route('member.integral.sure') }}";
            document.forms['form'].submit();
        }
    </script>
@endsection