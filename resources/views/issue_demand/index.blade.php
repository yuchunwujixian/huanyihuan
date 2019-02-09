@extends('public.base')

@section('title','供需信息库')

@section('css')
    <!-- 引入本页样式 -->
    <link rel="stylesheet" href="/dist/css/list/release.css">
    <style>
        .one-search-item span:nth-child(1){
              width: 16%;
          }
        .one-search-item span:nth-child(2){
            width: 8%;
        }
        .one-search-item span:nth-child(4){
             width: 7%;
         }
        .one-search-item span:nth-child(7){
            width: 18%;
        }
        .one-search-item span:nth-child(5){
            width: 14%;
        }
        .oneItem{
            width: 19%;
        }
        .gametype-more-show .region {
            margin-right: 10px;
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
            </a><a href="javascript:;" class="oneItem inline-block">
                发行需求榜
            </a><a href="{{ route('publishing.channel.demand.index') }}" class="oneItem inline-block">
                渠道需求榜
            </a><a href="{{ route('publishing.outsource.index') }}" class="oneItem inline-block">
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
                <span>平台：</span>
                @foreach($product_config['platform'] as $key => $value)
                    <a href="{{ route('publishing.issue.demand.index',array( 'platform' => $platform . ',' . $key, 'type' => $type, 'game_type' => $game_type, 'cooperation' => $cooperation, 'area' => $area, 'province' => $province)) }}">
                        <span  @if(in_array($key, explode(',', $platform))) class="platform square" @else class="platform square-o" @endif>
                                {{ $value }}
                        </span>
                    </a>
                @endforeach
            </div>
            <div class="one-select">
                <span>区分：</span>
                @foreach($product_config['type'] as $key => $value)
                    <a href="{{ route('publishing.issue.demand.index',array('platform' => $platform, 'type' => $type . ',' . $key, 'game_type' => $game_type, 'cooperation' => $cooperation, 'area' => $area, 'province' => $province)) }}">
                        <span @if(in_array($key, explode(',', $type))) class="distinguish square" @else class="distinguish square-o" @endif>
                                {{ $value }}
                        </span>
                    </a>
                @endforeach
            </div>
            <div class="one-select">
                <span>游戏分类：</span>
                @foreach($product_config['game_type_issue'] as $key => $value)
                    <a href="{{ route('publishing.issue.demand.index',array('platform' => $platform, 'type' => $type, 'game_type' => $key, 'cooperation' => $cooperation, 'area' => $area, 'province' => $province)) }}">
                        <span @if($key == $game_type) class="mode square" @else class="mode square-o" @endif>
                                {{ $value }}
                        </span>
                    </a>
                @endforeach
            </div>
            <div class="one-select">
                <span>合作方式：</span>
                @foreach($product_config['cooperation'] as $key => $value)
                    <a href="{{ route('publishing.issue.demand.index',array('platform' => $platform, 'type' => $type, 'game_type' => $game_type, 'cooperation' => $key, 'area' => $area, 'province' => $province)) }}">
                        <span @if($key == $cooperation) class="mode square" @else class="mode square-o" @endif>
                                {{ $value }}
                        </span>
                    </a>
                @endforeach
            </div>
            <div class="one-select">
                <span>代理区域：</span>
                @foreach($product_config['area'] as $key => $value)
                    <a href="{{ route('publishing.issue.demand.index',array('platform' => $platform, 'type' => $type, 'game_type' => $game_type, 'cooperation' => $cooperation, 'area' => $key, 'province' => $province)) }}">
                        <span @if(in_array($key, explode(',', $area))) class="need square" @else class="need square-o" @endif>
                                {{ $value }}
                        </span>
                    </a>
                @endforeach
            </div>
            <div class="one-select">
                <span>地区：</span>
                @foreach($province_config as $key => $value)
                    @if ($loop->index < 13)
                        <a href="{{ route('publishing.issue.demand.index',array('platform' => $platform, 'type' => $type, 'game_type' => $game_type, 'cooperation' => $cooperation, 'area' => $area, 'province' => $key)) }}">
                            <span @if($key == $province) class="region square" @else class="region square-o" @endif onclick="window.location.href=''">
                                    {{ $value }}
                            </span>
                        </a>
                    @endif
                @endforeach
                <span class="gametype-more">更多</span>
                <div class="gametype-more-show" style="padding-left:48px;">
                    @foreach($province_config as $key => $value)
                        @if ($loop->index >= 13)
                            <span @if($key == $province) class="region square" @else class="region square-o" @endif  onclick="window.location.href='{{ route('publishing.issue.demand.index',array('platform' => $platform, 'type' => $type, 'game_type' => $game_type, 'cooperation' => $cooperation, 'area' => $area, 'province' => $key)) }}'">{{ $value }}</span>
                        @endif
                    @endforeach
                </div>
            </div>
            @if($platform || $type || $game_type || $cooperation || $area || $province)
            <div id="parameter-show">
                已选条件：
                @if($platform)
                <div class="inline-block parameter-show"><span>平台：</span>@foreach (explode(',', $platform) as $v) @if($v)<span class="one-parameter" name="platform" onclick="window.location.href='{{ route('publishing.issue.demand.index',array('platform' => $platform . ',' . $v, 'type' => $type, 'game_type' => $game_type, 'cooperation' => $cooperation, 'area' => $area, 'province' => $province)) }}'"><i>{{ $product_config['platform'][$v] }}</i> ×</span>@endif @endforeach</div>
                @endif
                @if($type)
                    <div class="inline-block parameter-show"><span>区分：</span> @foreach (explode(',', $type) as $v) @if($v)<span class="one-parameter" name="distinguish"  onclick="window.location.href='{{ route('publishing.issue.demand.index',array('platform' => $platform, 'type' => $type . ',' . $v, 'game_type' => $game_type, 'cooperation' => $cooperation, 'area' => $area, 'province' => $province)) }}'"><i>{{ $product_config['type'][$v] }}</i> ×</span>@endif @endforeach</div>
                @endif
                @if($game_type)
                    <div class="inline-block parameter-show"><span>游戏分类：</span><span class="one-parameter" name="gametype" onclick="window.location.href='{{ route('publishing.issue.demand.index',array('platform' => $platform, 'type' => $type, 'game_type' => 0, 'cooperation' => $cooperation, 'area' => $area, 'province' => $province)) }}'"><i>{{ $product_config['game_type_issue'][$game_type] }}</i> ×</span></div>
                @endif
                @if($cooperation)
                    <div class="inline-block parameter-show"><span>合作方式：</span><span class="one-parameter" name="mode" onclick="window.location.href='{{ route('publishing.issue.demand.index',array('platform' => $platform, 'type' => $type, 'game_type' => $game_type, 'cooperation' => 0, 'area' => $area, 'province' => $province)) }}'"><i>{{ $product_config['cooperation'][$cooperation] }}</i> ×</span></div>
                @endif
                @if($area)
                    <div class="inline-block parameter-show"><span>代理区域：</span><span class="one-parameter" name="need" onclick="window.location.href='{{ route('publishing.issue.demand.index',array('platform' => $platform, 'type' => $type, 'game_type' => $game_type, 'cooperation' => $cooperation, 'area' => 0, 'province' => $province)) }}'"><i>{{ $product_config['area'][$area] }}</i> ×</span></div>
                @endif
                @if($province)
                    <div class="inline-block parameter-show"><span>地区：</span><span class="one-parameter" name="region" onclick="window.location.href='{{ route('publishing.issue.demand.index',array('platform' => $platform, 'type' => $type, 'game_type' => $game_type, 'cooperation' => $cooperation, 'area' => $area, 'province' => 0)) }}'"><i>{{ $province_config[$province] }}</i> ×</span></div>
                @endif
            </div>
            @endif
            <div id="search-show">
                <div class="search-title one-search-item">
					<span>
						公司
					</span><span>
						类型
					</span><span>
						平台
					</span><span>
						代理区域
					</span><span>
						合作方式
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
                                {{ $product_config['type'][$v->type_id] }}-{{ $product_config['game_type_issue'][$v->game_type_id] }}
                            </span><span>
                                @foreach(explode(',', $v['platform_id']) as $key => $value)
                                    {{$product_config['platform'][$value]}}/
                                @endforeach
                            </span><span>
                                {{ $product_config['area'][$v->area_id] }}
                            </span><span>
                                @foreach(explode(',', $v['cooperation_id']) as $key => $value)
                                    {{$product_config['cooperation'][$value]}}/
                                @endforeach
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
@section('js')
    <!-- 引入本页js文件 -->
    <script>
        $(".gametype-more").click(function () {
            if ($(this).next().css("display") === "none") {
                $(this).css({color: "#0064bc"}).next().css({ display: "block" });
            } else {
                $(this).css({color: "#4d4d4d"}).next().css({ display: "none" });
            }
        })
    </script>
@endsection

