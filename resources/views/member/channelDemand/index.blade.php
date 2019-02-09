@extends('public.base')

@section('title','用户中心-渠道需求榜')

@section('uc_here', '渠道需求榜')

@section('css')
    <!-- 引入本组公共样式 -->
    <link rel="stylesheet" href="/dist/css/personal/personal.css">
    <!-- 引入本页独立样式 -->
    <link rel="stylesheet" href="/dist/css/personal/research.css">
    <link rel="stylesheet" href="/dist/css/personal/gameproduct.css">
    <link rel="stylesheet" href="/dist/css/personal/recruitment.css">
@endsection

@section('content')
    @include('public.member_header')
    <!-- 内容部分 -->
    <div class="wrapper">
        @include('public.member_left')
        <div class="right-content">
            <div id="right-wrapper">
                @include('public.member_top')
                @if($is_register_company_info)
                    @if($company_info->status)
                    <div class="go-release-btn">
                            <a href="{{route('member.publishing.channelDemand.create')}}">
                                <span>发布渠道</span>
                                <span class="icon iconfont icon-jia"></span>
                            </a>
                    </div>
                    <div id="cruitment-content">
                        @if($data->total())
                        @foreach($data as $value)
                            <div class="one-item" style="position: relative">
                                <div class="one-item-title">
                                    @foreach(explode(',', $value['game_type_id']) as $key => $v)
                                    {{$product_config['game_type'][$v]}} |
                                    @endforeach
                                    <span>{{$product_config['status'][$value['status']]}}</span>
                                </div>
                                <div class="one-item-content" style="position: relative">
                                    <p>
                                        {{$value->title}} |
                                        {{$product_config['channel'][$value['channel_id']]}} |
                                        @foreach(explode(',', $value['type_id']) as $key => $v)
                                            {{$product_config['type'][$v]}} /
                                        @endforeach|
                                        {{$product_config['channel_cooperation'][$value['cooperation_id']]}} |
                                        @foreach(explode(',', $value['platform_id']) as $key => $v)
                                            {{$product_config['channel_platform'][$v]}} /
                                        @endforeach
                                    </p>
                                    <p>联系人信息 ： {{$value->contact}} -- {{$product_config['tel_type'][$value->tel_type_id]}} : {{$value->telephone}}</p>
                                    <p>{{$value->updated_at}}</p>
                                    @if($value['status'] != -1)
                                    <div class="operation">
                                        <a class="inline-block" href="{{ route('member.publishing.channelDemand.update', ['id' => $value->id]) }}">
                                            <i class="icon iconfont icon-edit"></i>
                                            编辑需求
                                        </a>
                                        <a class="inline-block del" href="javascript:;">
                                            <i class="icon iconfont icon-shanchu"></i>
                                            删除需求
                                        </a>
                                        <input type="hidden" value="{{ $value->id }}">
                                    </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        @else
                            <style>#cruitment-content{text-align: center;padding-top: 10px;}</style>
                            <span>暂无数据，请先添加数据！！！</span>
                        @endif
                    </div>
                    @else
                        <span style="color:red">您的企业信息未通过审核，请在审核通过后发布</span>
                    @endif
                    <style>
                        .page {margin-top: 30px}
                        .page ul li {float: left; width: 25px}
                    </style>
                    <div class="page">
                        {{ $data->links() }}
                    </div>
                @else
                    <p>您还为注册企业信息，<a href="{{route('member.company.index')}}">前往注册</a> </p>
                @endif
            </div>
        </div>
    </div>
    </div>
@endsection

@section('js')
    <script src="/dist/js/personal/research.js"></script>
    <script>
        $('.more').on('mouseenter', function() {
            $(this).next().show();
        });
        $('.select-area-hover').on('mouseenter', function() {
            $(this).show();
        });
        $('.select-area-hover').on('mouseleave', function() {
            $(this).hide();
        });
    </script>
    <link href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        $('.del').click(function(){
            if(confirm("确定要删除数据")){
                var id = $(this).next().val();
                $.ajax({
                    url:"{{ route('member.publishing.channelDemand.destroy') }}",
                    type:"POST",
                    dataType : 'json',
                    data:{"id" : id, '_token' : "{{csrf_token()}}"},
                    success : function(data) {
                        if (data.code == 0) {
                            toastr.options = {"positionClass":"toast-top-center"};
                            toastr.success(data.message,'');
                            window.location.reload();
                        } else {
                            toastr.options = {"positionClass":"toast-top-center"};
                            toastr.error(data.message,'');
                        }
                    }
                })
            }
        })
    </script>
@endsection