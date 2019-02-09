@extends('public.base')

@section('title','供需信息库')

@section('css')
    <!-- 引入本页样式 -->
    <link rel="stylesheet" href="/dist/css/list/channel.css">
    <style>
        .one-search-item span:nth-child(1){
              width: 8%;
          }
        .one-search-item span:nth-child(3){
             width: 15%;
         }
        .one-search-item span:nth-child(5){
            width: 17%;
        }
        .one-search-item span:nth-child(6){
            width: 10%;
        }
        .one-search-item span:nth-child(4){
            width: 8%;
        }
        .one-search-item span:nth-child(7){
            width: 16%;
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
            </a><a href="{{ route('publishing.issue.demand.index') }}" class="oneItem inline-block">
                发行需求榜
            </a><a href="javascript:;" class="oneItem inline-block">
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
                <span>渠道类型：</span>
                @foreach($product_config['channel'] as $key => $value)
                    <a href="{{ route('publishing.channel.demand.index',array('platform' => $platform, 'type' => $type, 'game_type' => $game_type, 'cooperation' => $cooperation, 'channel' => $key, 'province' => $province)) }}">
                        <span @if($key == $channel) class="need square" @else class="need square-o" @endif>
                                {{ $value }}
                        </span>
                    </a>
                @endforeach
            </div>
            <div class="one-select">
                <span>平台：</span>
                @foreach($product_config['channel_platform'] as $key => $value)
                    <a href="{{ route('publishing.channel.demand.index',array( 'platform' => $platform . ',' . $key, 'type' => $type, 'game_type' => $game_type, 'cooperation' => $cooperation, 'channel' => $channel, 'province' => $province)) }}">
                        <span  @if(in_array($key, explode(',', $platform))) class="platform square" @else class="platform square-o" @endif>
                                {{ $value }}
                        </span>
                    </a>
                @endforeach
            </div>
            <div class="one-select">
                <span>区分：</span>
                @foreach($product_config['type'] as $key => $value)
                    <a href="{{ route('publishing.channel.demand.index',array('platform' => $platform, 'type' => $type . ',' . $key, 'game_type' => $game_type, 'cooperation' => $cooperation, 'channel' => $channel, 'province' => $province)) }}">
                        <span @if(in_array($key, explode(',', $type))) class="distinguish square" @else class="distinguish square-o" @endif>
                                {{ $value }}
                        </span>
                    </a>
                @endforeach
            </div>
            <div class="one-select">
                <span>游戏分类：</span>
                @foreach($product_config['game_type'] as $key => $value)
                    <a href="{{ route('publishing.channel.demand.index',array('platform' => $platform, 'type' => $type, 'game_type' => $game_type . ',' . $key, 'cooperation' => $cooperation, 'channel' => $channel, 'province' => $province)) }}" >
                        <span @if(in_array($key, explode(',', $game_type))) class="gametype square" @else class="gametype square-o" @endif>
                                {{ $value }}
                        </span>
                    </a>
                @endforeach
                <a href="{{ route('publishing.channel.demand.index',array('platform' => $platform, 'type' => $type, 'game_type' => 0, 'cooperation' => $cooperation, 'channel' => $channel, 'province' => $province)) }}" >
                        <span @if($game_type === '0') class="gametype square" @else class="gametype square-o" @endif>
                                类型不限
                        </span>
                </a>
            </div>
            <div class="one-select">
                <span>合作方式：</span>
                @foreach($product_config['channel_cooperation'] as $key => $value)
                    <a href="{{ route('publishing.channel.demand.index',array('platform' => $platform, 'type' => $type, 'game_type' => $game_type, 'cooperation' => $key, 'channel' => $channel, 'province' => $province)) }}">
                        <span @if($key == $cooperation) class="mode square" @else class="mode square-o" @endif>
                                {{ $value }}
                        </span>
                    </a>
                @endforeach
            </div>

            <div class="one-select">
                <span>地区：</span>
                @foreach($province_config as $key => $value)
                    @if ($loop->index < 13)
                        <a href="{{ route('publishing.channel.demand.index',array('platform' => $platform, 'type' => $type, 'game_type' => $game_type, 'cooperation' => $cooperation, 'channel' => $channel, 'province' => $key)) }}">
                            <span @if($key == $province) class="region square" @else class="region square-o" @endif >
                                    {{ $value }}
                            </span>
                        </a>
                    @endif
                @endforeach
                <span class="gametype-more">更多</span>
                <div class="gametype-more-show" style="padding-left:48px;">
                    @foreach($province_config as $key => $value)
                        @if ($loop->index >= 13)
                            <span @if($key == $province) class="region square" @else class="region square-o" @endif  onclick="window.location.href='{{ route('publishing.channel.demand.index',array('platform' => $platform, 'type' => $type, 'game_type' => $game_type, 'cooperation' => $cooperation, 'channel' => $channel, 'province' => $key)) }}'">{{ $value }}</span>
                        @endif
                    @endforeach
                </div>
            </div>
            @if($platform || $type || $game_type || $cooperation || $channel || $province)
            <div id="parameter-show">
                已选条件：
                @if($platform)
                <div class="inline-block parameter-show"><span>平台：</span>@foreach (explode(',', $platform) as $v) @if($v)<span class="one-parameter" name="platform" onclick="window.location.href='{{ route('publishing.channel.demand.index',array('platform' => $platform . ',' . $v, 'type' => $type, 'game_type' => $game_type, 'cooperation' => $cooperation, 'channel' => $channel, 'province' => $province)) }}'"><i>{{ $product_config['channel_platform'][$v] }}</i> ×</span>@endif @endforeach</div>
                @endif
                @if($type)
                    <div class="inline-block parameter-show"><span>区分：</span> @foreach (explode(',', $type) as $v) @if($v)<span class="one-parameter" name="distinguish"  onclick="window.location.href='{{ route('publishing.channel.demand.index',array('platform' => $platform, 'type' => $type . ',' . $v, 'game_type' => $game_type, 'cooperation' => $cooperation, 'channel' => $channel, 'province' => $province)) }}'"><i>{{ $product_config['type'][$v] }}</i> ×</span>@endif @endforeach</div>
                @endif
                @if($game_type)
                    <div class="inline-block parameter-show"><span>游戏分类：</span>@foreach (explode(',', $game_type) as $v) @if($v)<span class="one-parameter" name="gametype" onclick="window.location.href='{{ route('publishing.channel.demand.index',array('platform' => $platform, 'type' => $type, 'game_type' => $game_type . ',' . $v, 'cooperation' => $cooperation, 'channel' => $channel, 'province' => $province)) }}'"><i>{{ $product_config['game_type'][$v] }}</i> ×</span>@endif @endforeach</div>
                @endif
                @if($cooperation)
                    <div class="inline-block parameter-show"><span>合作方式：</span><span class="one-parameter" name="mode" onclick="window.location.href='{{ route('publishing.channel.demand.index',array('platform' => $platform, 'type' => $type, 'game_type' => $game_type, 'cooperation' => 0, 'channel' => $channel, 'province' => $province)) }}'"><i>{{ $product_config['channel_cooperation'][$cooperation] }}</i> ×</span></div>
                @endif
                @if($channel)
                    <div class="inline-block parameter-show"><span>渠道类型：</span><span class="one-parameter" name="need" onclick="window.location.href='{{ route('publishing.channel.demand.index',array('platform' => $platform, 'type' => $type, 'game_type' => $game_type, 'cooperation' => $cooperation, 'channel' => 0, 'province' => $province)) }}'"><i>{{ $product_config['channel'][$channel] }}</i> ×</span></div>
                @endif
                @if($province)
                    <div class="inline-block parameter-show"><span>地区：</span><span class="one-parameter" name="region" onclick="window.location.href='{{ route('publishing.channel.demand.index',array('platform' => $platform, 'type' => $type, 'game_type' => $game_type, 'cooperation' => $cooperation, 'channel' => $channel, 'province' => 0)) }}'"><i>{{ $province_config[$province] }}</i> ×</span></div>
                @endif
            </div>
            @endif
            <div id="search-show">
                <div class="search-title one-search-item">
					<span>
						渠道类型
					</span><span>
						渠道名
					</span><span>
						区分
					</span><span>
						合作方式
					</span><span>
						公司名称
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
                               {{ $product_config['channel'][$v->channel_id] }}
                            </span><span>
                                {{ $v->title }}
                            </span><span>
                               @foreach(explode(',', $v['type_id']) as $key => $va)
                                    {{$product_config['type'][$va]}} /
                                @endforeach
                            </span><span>
                                {{ $product_config['channel_cooperation'][$v->cooperation_id] }}
                            </span><span>
                                <a target="_blank" href="{{ route('company.show', ['id' => $v->companyInfo->id]) }}">{{ $v->companyInfo->title }}</a>
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

