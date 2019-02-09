@extends('public.base')

@section('title','供需信息库')

@section('css')
    <!-- 引入本页样式 -->
    <link rel="stylesheet" href="/dist/css/list/outsource.css">
    <link rel="stylesheet" href="/dist/css/list/outsource_need.css">
    <style>
        .one-search-item span:nth-child(1){
              width: 20%;
          }
        .one-search-item span:nth-child(2) {
            width: 8%;
        }
        .one-search-item span:nth-child(4){
            width: 26%;
        }
        .one-search-item span:nth-child(6){
            width: 16%;
        }
        .one-search-item span:nth-child(3){
            width: 8%;
        }
        .one-search-item span:nth-child(5){
            width: 8%;
        }
        .one-search-item span:nth-child(7){
            width: 12%;
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
            </a><a href="{{ route('publishing.issue.demand.index') }}" class="oneItem inline-block">
                发行需求榜
            </a><a href="{{ route('publishing.channel.demand.index') }}" class="oneItem inline-block">
                渠道需求榜
            </a><a href="javascript:;" class="oneItem inline-block">
                外包供需榜
            </a><a href="{{ route('publishing.open.test.index') }}" class="oneItem inline-block">
                游戏开测榜
            </a>
            {{--<a href="#" class="oneItem inline-block">--}}
                {{--游戏产品榜--}}
            {{--</a>--}}
        </div>
    </div>
    <!-- container -->
    <div class="content">
        <div class="container">
            <div class="one-select">
                <span>外包类型：</span>
                @foreach($product_config['outsource'] as $key => $value)
                    <a href="{{ route('publishing.outsource.index',array('outsource' => $key, 'precondition' => $precondition)) }}">
                        <span @if($key == $outsource) class="need square" @else class="need square-o" @endif>
                                {{ $value }}
                        </span>
                    </a>
                @endforeach
            </div>
            <div class="one-select">
                <span>前置条件：</span>
                @foreach($product_config['precondition'] as $key => $value)
                    <a href="{{ route('publishing.outsource.index',array('outsource' => $outsource, 'precondition' => $key)) }}">
                        <span @if($key == $precondition) class="mode square" @else class="mode square-o" @endif>
                                {{ $value }}
                        </span>
                    </a>
                @endforeach
            </div>
            @if($precondition || $outsource)
            <div id="parameter-show">
                已选条件：
                @if($outsource)
                    <div class="inline-block parameter-show"><span>外包类型：</span><span class="one-parameter" name="need" onclick="window.location.href='{{ route('publishing.outsource.index',array('outsource' => 0, 'precondition' => $precondition)) }}'"><i>{{ $product_config['outsource'][$outsource] }}</i> ×</span></div>
                @endif
                @if($precondition)
                    <div class="inline-block parameter-show"><span>前置条件：</span><span class="one-parameter" name="region" onclick="window.location.href='{{ route('publishing.outsource.index',array('outsource' => $outsource, 'precondition' => 0)) }}'"><i>{{ $product_config['precondition'][$precondition] }}</i> ×</span></div>
                @endif
            </div>
            @endif
            <div id="search-show">
                <div class="search-title one-search-item">
					<span>
						公司
					</span><span>
						前置条件
					</span><span>
						外包类型
					</span><span>
						简介
					</span><span>
						联系人
					</span><span>
						联系方式
					</span><span>
						发布时间
					</span>
                </div>
                @if($data->count())
                    @foreach($data as $v)
                        <div class="one-search-item">
                           <span>
                                <a target="_blank" href="{{ route('company.show', ['id' => $v->companyInfo->id]) }}">{{ $v->companyInfo->title }}</a>
                            </span><span>
                                {{ $product_config['precondition'][$v->precondition_id] }}
                            </span><span>
                                {{ $product_config['outsource'][$v->outsource_id] }}
                            </span><span>
                                  {{ $v->needs }}
                            </span><span>
                                {{ $v->contact }}
                            </span><span>
                                {{ $product_config['tel_type'][$v->tel_type_id] }}: {{ $v->telephone }}
                            </span><span>
                                {{date('Y.m.d', strtotime($v->updated_at))}}
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

