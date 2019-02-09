@extends('public.base')

@section('title','积分充值')

@section('uc_here', '积分充值')

@section('css')
    <link rel="stylesheet" href="/dist/css/personal/personal.css">
    <link rel="stylesheet" href="/dist/css/personal/mypoints.css">
    <style>
        .error {
            font-weight: bold;
            color: #EA5200;
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
            <form action="{{ route('member.integral.pay') }}" method="post" class="form">
                {{csrf_field()}}
                <div class="content-nav">
                    <a class="inline-block active-nav" href="javascript:;">我的积分</a>
                    <a class="inline-block" href="{{ route('member.integral.lists') }}">积分获取</a>
                    <a class="inline-block" href="{{ route('member.integral.answer') }}">我的回答@if(Auth::user()->messages(Auth::user()->id, 'view_feedback'))<font color="red">({{ Auth::user()->messages(Auth::user()->id, 'view_feedback') }})</font>@endif</a>
                    <a class="inline-block" href="{{ route('member.integral.question') }}">我的寻求@if(Auth::user()->messages(Auth::user()->id, 'view_issue'))<font color="red">({{ Auth::user()->messages(Auth::user()->id, 'view_issue') }})</font>@endif</a>
                    <a class="inline-block" href="{{ route('member.integral.logs') }}">充值记录</a>
                </div>
                <div id="recharge">
                    <div class="recharge-money">
                        请输入充值金额
                    </div>
                    <div class="recharge-input-money">
                        <div class="input-money-wrapper inline-block">
                            <input type="number" name="account" placeholder="请输入整数金额" style="background-color: white"/>
                        </div>
                        元
                    </div>
                    <div class="recharge-money">
                        支付类型（选择你要支付的方式）
                    </div>
                    <div>
                        @foreach($payment as $v)
                            <div style="display: block;border: 1px solid #ddd;width: 138px;padding: 10px;margin: 10px;">
                                <label>
                                    <input type="radio" name="payment" value="{{ $v['name'] }}" style="display: inline-block;vertical-align: middle"><img src="{{ $v['logo'] }}" style="display: inline-block;vertical-align: middle"/>
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <input value="立即支付" type="submit" id="recharge-btn">
                </div>
            </form>
        </div>
    </div>

@endsection
@section('js')
    <script>
        $.validator.setDefaults({
            errorPlacement : function(error, element) {//error为错误提示对象，element为出错的组件对象
                if (element.is(":radio")){
                    error.css("display","block").appendTo(element.parent().parent().parent()) ;
                }else{
                    element.after(error) ;//默认是加在 输入框的后面。这个else必须写。不然其他非radio的组件 就无法显示错误信息了。
                }
            }

        });
        $("#recharge-btn").click(function () {
            $(".form").validate({
                errorClass: "error",
                rules: {
                    account: {
                        required:true,
                        digits:true
                    },
                    payment:{
                        required : true
                    }
                },
                messages: {
                    account: "请输入整数金额",
                    payment: "请选择支付方式"
                }
            });
        })
    </script>
@endsection