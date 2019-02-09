@extends('public.base')

@section('title','用户中心-外包供需榜')

@section('uc_here', '外包供需榜')

@section('css')
    <!-- 引入本组公共样式 -->
    <link rel="stylesheet" href="/dist/css/personal/personal.css">
    <!-- 引入本页独立样式 -->
    <link rel="stylesheet" href="/dist/css/personal/research.css">
    <link rel="stylesheet" href="/dist/css/personal/gameproduct.css">
    <link rel="stylesheet" href="/dist/css/personal/releaselist.css">
@endsection

@section('content')
    @include('public.member_header')
    <!-- 内容部分 -->
    <div class="wrapper">
        @include('public.member_left')
        <div class="right-content">
            <form id="right-wrapper" action="{{ route('member.publishing.outsource.store') }}" method="post">
                {{csrf_field()}}
                @include('public.member_top')
                <div class="one-demand-content">
                    <div class="one-demand-name">
                        外包类别
                    </div>
                    <div class="one-demand relative">
                        @foreach($product_config['outsource'] as $key => $value)
                            <input type="radio" name="outsource_id" value="{{ $key }}">{{ $value }}
                        @endforeach
                    </div>
                </div>
                <div class="one-demand-content">
                    <div class="one-demand-name">
                        外包名称
                    </div>
                    <div class="one-demand relative">
                        <input type="text" class="inputlist" name="title" placeholder="请输入外包名称">
                    </div>
                </div>
                <div class="one-demand-content" style="height: auto">
                    <div class="one-demand-name">
                        前置条件
                    </div>
                    <div class="one-demand relative" style="height: auto">
                        @foreach($product_config['precondition'] as $key => $value)
                            <input type="radio" name="precondition_id" value="{{ $key }}">{{ $value }}
                        @endforeach
                    </div>
                </div>
                <div class="one-demand-content">
                    <div class="one-demand-name">
                        联系人
                    </div>
                    <div class="one-demand relative">
                        <input type="text" class="inputlist" name="contact" placeholder="请输入联系人">
                    </div>
                </div>
                <div class="one-demand-content">
                    <div class="one-demand-name">
                        联系方式
                    </div>
                    <div class="one-demand relative">
                        <select name="tel_type_id" style="display: inline-block;width: 14%;height: 30px;">
                            @foreach($product_config['tel_type'] as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                        <input style="display: inline-block;width: 85%;" type="text" class="inputlist" name="telephone" placeholder="请输入联系方式">
                    </div>
                </div>
                <div class="one-demand-content">
                    <div class="one-demand-name">
                        简介说明
                    </div>
                    <div class="one-demand relative">
                        <input type="text" class="inputlist" name="needs" placeholder="请简要说明一下供需">
                    </div>
                </div>
                <div class="one-demand-content"  style="height: auto">
                    <div class="one-demand-name">
                        外包介绍
                    </div>
                    <div class="one-demand relative"  style="height: auto">
                        <textarea class="introduction" name="description" placeholder="请输入外包介绍"  rows="12" cols="70" contenteditable="true"></textarea>
                    </div>
                </div>
                <input type="submit" value="发布" id="releasebtn" style="margin: 30px auto;">
            </form>
        </div>
    </div>
    </div>
@endsection

@section('js')
    <script src="/dist/js/personal/releaselist.js"></script>
    <link rel="stylesheet" type="text/css" href="/plugins/uploadify_3.2.1/uploadify.css">
    <script type="text/javascript" src="/plugins/uploadify_3.2.1/jquery.uploadify.js"></script>
@endsection