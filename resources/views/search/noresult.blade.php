@extends('public.base')

@section('title','搜索详情页')

@section('css')
    <link rel="stylesheet" href="/dist/css/search/search.css">
    <link rel="stylesheet" href="/dist/css/search/noresult.css">
    <style>
        .type-search{
            float: left;
            height: 42px;
            margin: 4px 0 0 5px;
            background-color: rgba(255, 255, 255, 0.8);
            border: none;
            width: 72px;
        }
    </style>
@endsection

@section('content')
    <!-- 中部banner区域 -->
    <div class="banner">
        <img class="banner-bg" src="/dist/img/banner.png" alt="banner">
        <form action="{{ route('search.index') }}" method="post" name="form" class="form">
            {{csrf_field()}}
            <div class="search-wrapper">
                <select class="type-search" name="type_search">
                    <option value="1">找公司</option>
                    <option value="2">找产品</option>
                    {{--<option value="3">找联系人</option>--}}
                </select>
                <input type="text" placeholder="找公司/找产品" style="width: 300px;" name="condition">
                <div class="search">
                    <img src="{{asset('dist/img/search.png')}}" class="search-icon" onclick="javascript:{document.forms['form'].submit();}">
                </div>
                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <div id="textInfo-error" class="error" style="text-align: center;margin-top: 60px;color: red">{{$error}}</div>
                    @endforeach
                @endif
            </div>
        </form>
    </div>
    <!-- 中部导航区域 -->
    {{--<ul class="search-nav">--}}
        {{--<li>--}}
            {{--<a href="#" class="active">--}}
                {{--<span class="nav-item">公司</span>--}}
                {{--<span></span>--}}
            {{--</a>--}}
        {{--</li>--}}
        {{--<li>--}}
            {{--<a href="search_game.html">--}}
                {{--<span class="nav-item">游戏</span>--}}
                {{--<span></span>--}}
            {{--</a>--}}
        {{--</li>--}}
        {{--<li>--}}
            {{--<a href="search_service.html">--}}
                {{--<span class="nav-item">服务</span>--}}
                {{--<span></span>--}}
            {{--</a>--}}
        {{--</li>--}}
        {{--<li>--}}
            {{--<a href="search_copyright.html">--}}
                {{--<span class="nav-item">著作权</span>--}}
                {{--<span></span>--}}
            {{--</a>--}}
        {{--</li>--}}
        {{--<li>--}}
            {{--<a href="search_edition.html">--}}
                {{--<span class="nav-item">版号</span>--}}
                {{--<span></span>--}}
            {{--</a>--}}
        {{--</li>--}}
    {{--</ul>--}}
    <!-- 中部搜索结果区域 -->
    <div class="search-total">
        <p>共找到0条相关信息</p>
    </div>
    <div class="search-result">
        <div class="search-item">
            <p class="blankInfo">没有想要的信息？点击提交需求，委托小囧帮您找！</p>
            <form class="feedback clearfix" action="{{ route('member.integral.store') }}" method="post" name="formone">
                {{csrf_field()}}
                <textarea id="needs" name="needs" placeholder="请输入你想要找到信息！" style="background-color: white;height: 250px;width:88%;padding: 30px">{{ $condition }}</textarea>
                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <label id="textInfo-error" class="error" for="textInfo">请输入信息</label>
                    @endforeach
                @endif
                <p class="point-info" style="float: left;margin-left: 30px;color: red"><a href="{{ route('member.integral.index') }}" style="color: red">本次委托将花费您的<font color="#3d7dc5">5</font>个积分</a></p>
                @if(Auth::check())
                    {{--<input type="button" value="提交" class="submit" onclick="javascript:{this.disabled=true;document.forms['formone'].submit();}" style="background-color: #0063bc;color: white;margin: 10px 30px 0 0;">--}}
                    <input type="submit" value="提交" class="submit" style="background-color: #0063bc;color: white;margin: 10px 30px 0 0;">
                @else
                    <input type="button" value="提交" onclick="window.location.href='{{route('login')}}'" style="background-color: #0063bc;color: white;margin: 10px 30px 0 0;">
                @endif
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
                    needs: "required"
                },
                messages: {
                    needs: "请输入信息"
                }
            });
        });
    </script>
@endsection