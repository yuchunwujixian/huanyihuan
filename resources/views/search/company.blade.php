@extends('public.base')

@section('title','搜索详情页')

@section('css')
    <link rel="stylesheet" href="/dist/css/search/search_company.css">
    <link rel="stylesheet" href="/dist/css/search/search.css">
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
    <!-- 中部搜索结果区域 -->
    <div class="search-total">
        <p>共找到{{ $data->count() }}条相关信息<a href="{{ route('search.noresult') }}" style="color: #0064bc;margin-left: 5px;">没有想要的信息？点击提交需求，一键委托网站查找</a></p>
    </div>
    <div class="search-result">
        <div class="search-item">
            <div class="item-company">
                <p class="item-title">公司</p>
                @foreach($data as $v)
                <div class="company-title">
                    <div class="logo-wrapper">
                        <a href="{{ route('company.show', ['id' => $v->id]) }}" target="_blank"><img src="{{ $v->logo }}"></a>
                    </div>
                    <h2>
                        <a href="{{ route('company.show', ['id' => $v->id]) }}" target="_blank">{{ $v->title }}</a>
                        <div>
                            <p>定位： {{$v->CompanyTypes($v->position)}}</p>
                            <p>联系人： {{ $v->contact }}</p>
                            <p>公司官网： {{ $v->url }}</p>
                        </div>
                    </h2>
                    <div class="inline-block compony-info">
                        <h2>公司简介</h2>
                        <div>
                            <textarea  name="description" id="description"  onpropertychange="this.style.height = this.scrollHeight + 'px';" oninput="this.style.height = this.scrollHeight + 'px';" style="width: 95%;height: 96%;overflow-x: hidden;overflow-y: hidden;resize: none;border: 0;background-color: white" disabled>{{ str_limit($v->description, 250) }}</textarea>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.getElementById("description").style.height = document.getElementById("description").scrollHeight + 10 + "px";
    </script>
@endsection