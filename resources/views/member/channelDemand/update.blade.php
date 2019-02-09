@extends('public.base')

@section('title','用户中心-渠道需求榜')

@section('uc_here', '渠道需求榜')

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
            <form id="right-wrapper" action="{{ route('member.publishing.channelDemand.store') }}" method="post">
                <input value="{{ $data->id }}" type="hidden" name="id">
                {{csrf_field()}}
                @include('public.member_top')
                <div class="one-demand-content">
                    <div class="one-demand-name">
                        渠道类别
                    </div>
                    <div class="one-demand relative">
                        @foreach($product_config['channel'] as $key => $value)
                            <input type="radio" name="channel_id" value="{{ $key }}" @if($key == $data->channel_id) checked @endif>{{ $value }}
                        @endforeach
                    </div>
                </div>
                <div class="one-demand-content">
                    <div class="one-demand-name">
                        产品名
                    </div>
                    <div class="one-demand relative">
                        <input type="text" class="inputlist" name="title" placeholder="请输入产品名" value="{{ $data->title }}">
                    </div>
                </div>
                <div class="one-demand-content" style="height: auto">
                    <div class="one-demand-name">
                        我们再找
                    </div>
                    <div class="one-demand relative" style="height: auto">
                        <label for="select_All" style="display:inline-block;margin:0 10px;width: 60px;height: 30px;"> <input type="checkbox" value="全部" id="select_All">全部</label>
                        @foreach($product_config['game_type'] as $key => $value)
                            <label for="{{$key}}" style="display:inline-block;margin:0 10px;width: 60px;height: 30px;"><input type="checkbox" name="game_type_id[]" value="{{ $key }}" id="{{ $key }}" @if(in_array($key, explode(',', $data->game_type_id))) checked @endif>{{ $value }}</label>
                        @endforeach
                    </div>
                </div>
                <div class="one-demand-content">
                    <div class="one-demand-name">
                        平台
                    </div>
                    <div class="one-demand relative">
                        @foreach($product_config['channel_platform'] as $key => $value)
                            <input type="checkbox" name="platform_id[]" value="{{ $key }}" id="{{ $key }}" @if(in_array($key, explode(',', $data->platform_id))) checked @endif>{{ $value }}
                        @endforeach
                    </div>
                </div>
                <div class="one-demand-content">
                    <div class="one-demand-name">
                        合作方式
                    </div>
                    <div class="one-demand relative">
                        @foreach($product_config['channel_cooperation'] as $key => $value)
                            <input type="radio" name="cooperation_id" value="{{ $key }}" @if($key == $data->cooperation_id) checked @endif>{{ $value }}
                        @endforeach
                    </div>
                </div>
                <div class="one-demand-content">
                    <div class="one-demand-name">
                        区分
                    </div>
                    <div class="one-demand relative">
                        @foreach($product_config['type'] as $key => $value)
                            <input type="checkbox" name="type_id[]" value="{{ $key }}"  @if(in_array($key, explode(',', $data->type_id))) checked @endif>{{ $value }}
                        @endforeach
                    </div>
                </div>
                <div class="one-demand-content">
                    <div class="one-demand-name">
                        联系人
                    </div>
                    <div class="one-demand relative">
                        <input type="text" class="inputlist" name="contact" placeholder="请输入联系人" value="{{ $data->contact }}">
                    </div>
                </div>
                <div class="one-demand-content">
                    <div class="one-demand-name">
                        联系方式
                    </div>
                    <div class="one-demand relative">
                        <select name="tel_type_id" style="display: inline-block;width: 14%;height: 30px;">
                            @foreach($product_config['tel_type'] as $key => $value)
                                <option value="{{ $key }}" @if($key == $data->tel_type_id) selected @endif>{{ $value }}</option>
                            @endforeach
                        </select>
                        <input style="display: inline-block;width: 85%;" type="text" class="inputlist" name="telephone" placeholder="请输入联系方式" value="{{ $data->telephone }}">
                    </div>
                </div>
                <div class="one-demand-content"  style="height: auto">
                    <div class="one-demand-name">
                        产品介绍
                    </div>
                    <div class="one-demand relative"  style="height: auto">
                        <textarea class="introduction" name="description" placeholder="请输入产品介绍"  rows="12" cols="70" contenteditable="true">{{ $data->description }}</textarea>
                    </div>
                </div>
                <div class="one-demand-content" style="height: auto">
                    <div class="one-demand-name">
                        需求及合作
                    </div>
                    <div class="one-demand relative" style="height: auto">
                        <textarea placeholder="请输入需求及合作" name="needs"  rows="12" cols="70">{{ $data->needs }}</textarea>
                    </div>
                </div>
                <input type="submit" value="保存" id="releasebtn" style="margin: 30px auto;">
            </form>
        </div>
    </div>
    </div>
@endsection

@section('js')
    <script src="/dist/js/personal/releaselist.js"></script>
    <link rel="stylesheet" type="text/css" href="/plugins/uploadify_3.2.1/uploadify.css">
    <script type="text/javascript" src="/plugins/uploadify_3.2.1/jquery.uploadify.js"></script>
    <script>
        $().ready(function () {
            //checkbox 全选/取消全选
            var isCheckAll = false;
            $('#selectAll').on('click', function() {
                if (isCheckAll) {
                    $("input[name='platform_id[]']").each(function() {
                        this.checked = false;
                    });
                    isCheckAll = false;
                } else {
                    $("input[name='platform_id[]']").each(function() {
                        this.checked = true;
                    });
                    isCheckAll = true;
                }
            })
            var isCheck_All = false;
            $('#select_All').on('click', function() {
                if (isCheck_All) {
                    $("input[name='game_type_id[]']").each(function() {
                        this.checked = false;
                    });
                    isCheck_All = false;
                } else {
                    $("input[name='game_type_id[]']").each(function() {
                        this.checked = true;
                    });
                    isCheck_All = true;
                }
            })
        })
    </script>
@endsection