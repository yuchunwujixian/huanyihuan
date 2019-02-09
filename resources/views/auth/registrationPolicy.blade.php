@extends('public.base')

@section('title','用户协议')
@section('css')
    <link rel="stylesheet" href="/dist/css/reset.css">
    <link rel="stylesheet" type="text/css" href="/dist/css/account/account.css"/>
    <link rel="stylesheet" href="/dist/css/account/register.css">
@endsection

@section('content')
    {{--<div class="containter">--}}
        {{--<iframe src="./userPolicy.html" style="width: 1024px; margin: 0 auto; display: block; height: 7700px;" scrolling="no" id="myiframe" frameborder="0"></iframe>--}}
    {{--</div>--}}
    <div style="width: 1024px; margin: 0 auto; display: block;">
        @include('auth.userPolicy')
    </div>
@endsection
