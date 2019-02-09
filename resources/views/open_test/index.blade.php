@extends('public.base')

@section('title','供需信息库')

@section('css')
    <!-- 引入本页样式 -->
    <link rel="stylesheet" href="/dist/css/list/game_test.css">
    <style>
        .one-search-item span:nth-child(1) {
            width: 10%;
        }
        .one-search-item span:nth-child(2){
            width: 10%;
        }
        .one-search-item span:nth-child(3){
             width: 8%;
         }
        .one-search-item span:nth-child(4){
            width: 14%;
        }
        .one-search-item span:nth-child(5){
            width: 10%;
        }
        .one-search-item span:nth-child(6){
            width: 18%;
        }
        .one-search-item span:nth-child(7){
            width: 17%;
        }
        .oneItem{
            width: 19%;
        }
    </style>
@endsection

@section('content')
    <div class="banner">
        <img src="/dist/img/connect-banner.png">
    </div>
    <!-- nav导航 -->
    <div class="nav">
        <div class="container">
            <a href="{{ route('publishing.product.index') }}" class="oneItem inline-block">
                产品研发榜
            </a><a href="javascript{{ route('publishing.issue.demand.index') }}" class="oneItem inline-block">
                发行需求榜
            </a><a href="{{ route('publishing.channel.demand.index') }}" class="oneItem inline-block">
                渠道需求榜
            </a><a href="{{ route('publishing.outsource.index') }}" class="oneItem inline-block">
                外包供需榜
            </a><a href="javascript:;" class="oneItem inline-block">
                游戏开测榜
            </a>
            {{--<a href="#" class="oneItem inline-block">--}}
                {{--游戏产品榜--}}
            {{--</a>--}}
        </div>
    </div>
    <!-- container -->
    <div class="content" style="margin-top: 40px">
        <div class="container">
            <div id="search-show">
                <div class="search-title one-search-item">
					<span>
						游戏名称
					</span><span>
						游戏类型
					</span><span>
						测试类型
					</span><span>
						测试平台
					</span><span>
						其他
					</span><span>
						研发方
					</span><span>
						发行方
					</span><span>
						测试时间
					</span>
                </div>
                @if($data->count())
                    @foreach($data as $v)
                        <div class="one-search-item">
                           <span>
                                <a target="_blank" href="{{ route('product.show', ['id' => $v->productInfo->id]) }}">{{ $v->productInfo->title }}</a>
                            </span><span>
                                {{ $product_config['game_type'][$v->productInfo->game_type_id] }} |   {{ $product_config['type'][$v->productInfo->type_id] }}
                            </span><span>
                                {{ $product_config['schedule'][$v->schedule_id] }}
                            </span><span>
                                 @foreach($v->platformInfo($v->platform_id) as $key => $value)
                                    {{$product_config['platform'][$value]}}|
                                @endforeach
                            </span><span>
                               @if($v->is_billing) 计费 @else 不计费 @endif  @if($v->is_del) 删档 @else 不删档 @endif
                            </span><span>
                                {{ $v->research }}
                            </span><span>
                                {{ $v->issue }}
                            </span><span>
                                {{$v->open_time}}
                            </span>
                        </div>
                    @endforeach
                @else
                    <div class="one-search-item" style="text-align: center">
                    <span>暂无数据！</span>
                    </div>
                @endif
            </div>
            <!-- 分页器 -->
            <div class="holder">
                {{ $data->links('job.page') }}
            </div>
        </div>
    </div>
@endsection

