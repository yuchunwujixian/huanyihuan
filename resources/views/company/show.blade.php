@extends('public.base')

@section('title','公司详情页')

@section('css')
    <link rel="stylesheet" href="/dist/css/company/company.css">
    <style>
        .product div span:nth-child(1){
             width: 16%;
         }
        .product div span:nth-child(2){
            width: 14%;
        }
        .product div span:nth-child(3){
            width: 10%;
        }
        .product div span:nth-child(4){
            width: 6%;
        }
        .product div span:nth-child(5){
            width: 14%;
        }
        .product div span:nth-child(6){
            width: 12%;
        }
        .product div span:nth-child(7){
            width: 20%;
        }
        .product div span:nth-child(8){
            width: 8%;
        }
        .issue div span:nth-child(1){
            width: 10%;
        }
        .issue div span:nth-child(2){
            width: 16%;
        }
        .issue div span:nth-child(3){
            width: 8%;
        }
        .issue div span:nth-child(4){
            width: 18%;
        }
        .issue div span:nth-child(5){
            width: 14%;
        }
        .issue div span:nth-child(6){
            width: 22%;
        }
        .issue div span:nth-child(7){
            width: 12%;
        }
    </style>
    <style>
        .channel div span:nth-child(1){
            width: 7%;
        }
        .channel div span:nth-child(2){
            width: 12%;
        }
        .channel div span:nth-child(3){
            width: 16%;
        }
        .channel div span:nth-child(4){
            width: 18%;
        }
        .channel div span:nth-child(5){
            width: 6%;
        }
        .channel div span:nth-child(6){
            width: 9%;
        }
        .channel div span:nth-child(7){
            width: 20%;
        }
        .channel div span:nth-child(8){
            width: 12%;
        }
    </style>
    <style>
        .outsource div span:nth-child(1){
            width: 18%;
        }
        .outsource div span:nth-child(2){
            width: 8%;
        }
        .outsource div span:nth-child(3) {
            width: 8%;
        }
        .outsource div span:nth-child(4){
            width: 26%;
        }
        .outsource div span:nth-child(5){
            width: 10%;
        }
        .outsource div span:nth-child(6){
            width: 22%;
        }
        .outsource div span:nth-child(7){
            width: 8%;
        }
    </style>
    <style>
        .test div span:nth-child(1) {
            width: 15%;
        }
        .test div span:nth-child(2){
            width: 10%;
        }
        .test div span:nth-child(3){
            width: 6%;
        }
        .test div span:nth-child(4){
            width: 14%;
        }
        .test div span:nth-child(5){
            width: 10%;
        }
        .test div span:nth-child(6){
            width: 18%;
        }
        .test div span:nth-child(7){
            width: 17%;
        }
    </style>
@endsection

@section('content')
    <!-- 中部内容区域 -->
    @if ($data)
    <div class="container">
        <div class="title">
            公司详情介绍
        </div>
        <div class="company-basic-info">
            <div class="company-basic-content" style="background:none;height: 100%">
                <div class="company-logo-left">
                    <div class="company-logo" style="width: 200px; height: 200px; margin-top:5px; margin-left: 10px">
                        <img src="{{ $data->logo }}"/>
                    </div>
                </div>
                <style>.company-info p {height: 35px}</style>
                <div class="company-info">
                    <p>
                        <span>公司：</span>
                        <span>{{ $data->title }}</span>
                    </p>
                    <p>
                        <span>类型：</span>
                        <span>{{ $data->CompanyTypes($data->position) }}</span>
                    </p>
                    <p>
                        <span>公司官网：</span>
                        <span><a href="{{ $data->url }}" target="_blank">{{ $data->url }}</a></span>
                    </p>
                    <p>
                        <span>联系人：</span>
                        <span>{{ $data->contact }}</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="title-common title-second">
            公司形象
        </div>
        <div class="company-image">
            <textarea  name="description" id="description"  onpropertychange="this.style.height = this.scrollHeight + 'px';" oninput="this.style.height = this.scrollHeight + 'px';" style="width: 95%;height: 96%;overflow-x: hidden;overflow-y: hidden;resize: none;border: 0;background-color: white" disabled>{{ $data->description }}</textarea>
        </div>
        <div class="title-common title-third">
            联系人
        </div>
        <div class="contact-content">
            <div class="contact-title">
            <span>
                姓名
            </span><span>
                职务
            </span><span>
                负责区域
            </span><span>
                负责事宜
            </span><span>
                联系方式
            </span>
            </div>
            @foreach($data->CompanyPersonInfo as $person)
                <div class="contact-info">
                    <span>
                        {{$person->name}}
                    </span><span>
                        {{$person->manage_position}}
                    </span><span>
                        {{$person->manage_area}}
                    </span><span>
                        {{$person->manage_matters}}
                    </span><span>
                        {{$person->telephone}}
                    </span>
                </div>
            @endforeach
        </div>
        <div class="title-common title-third">
            业务需求
        </div>
        <div class="business-nav">
            <ul>
                <li class="b-nav-active b-nav-item">产品研发榜</li>
                <li class="b-nav-item">发行需求榜</li>
                <li class="b-nav-item">渠道需求榜</li>
                <li class="b-nav-item">外包供需榜</li>
                <li class="b-nav-item">游戏开测榜</li>
            </ul>
        </div>
        <div class="business-requirement product">
            <div>
               <span>
                    产品
                </span><span>
                    类型
                </span><span>
                    合作方式
                </span><span>
                    代理区域
                </span><span>
                    平台
                </span><span>
                    联系人
                </span><span>
                    联系方式
                </span><span>
                    发布时间
                </span>
            </div>
            @foreach($data->companyProductInfo->where('status', 1) as $v)
            <div>
              <span>
                    <a target="_blank" href="{{ route('product.show', ['id' => $v->id]) }}">{{ $v->title }}</a>
                </span><span>
                    {{ $product_config['game_type'][$v->game_type_id] }}-{{ $product_config['type'][$v->type_id] }}-{{ $product_config['period'][$v->period_id] }}
                </span><span>
                    {{ $product_config['cooperation'][$v->cooperation_id] }}
                </span><span>
                    {{ $product_config['area'][$v->area_id] }}
                </span><span>
                    @foreach(explode(',', $v['platform_id']) as $key => $value)
                        {{$product_config['platform'][$value]}}/
                    @endforeach
                </span><span>
                    {{ $v->contact }}
                </span><span>
                    {{ str_limit($product_config['tel_type'][$v->tel_type_id], 4, '') }}: {{ $v->telephone }}
                </span><span>
                    {{date('Y.m.d', strtotime($v->updated_at))}}
                </span>
            </div>
            @endforeach
        </div>
        <div class="business-requirement issue" style="display: none;">
            <div>
                <span>
                    区分
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
            @foreach($data->CompanyIssueDemand->where('status', 1) as $v)
            <div>
                <span>
                    {{ $product_config['type'][$v->type_id] }}
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
        </div>
        <div class="business-requirement channel" style="display: none;">
            <div>
               <span>
                    渠道类型
                </span><span>
                    渠道名
                </span><span>
                    区分
                </span><span>
                    平台
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
            @foreach($data->CompanyChannelDemand->where('status', 1) as $v)
                <div>
                <span>
                   {{ $product_config['channel'][$v->channel_id] }}
                </span><span>
                    {{ $v->title }}
                </span><span>
                   @foreach(explode(',', $v['type_id']) as $key => $va)
                      {{$product_config['type'][$va]}} /
                    @endforeach
                </span><span>
                   @foreach(explode(',', $v['platform_id']) as $key => $va)
                            {{$product_config['channel_platform'][$va]}} /
                        @endforeach
                </span><span>
                    {{ $product_config['channel_cooperation'][$v->cooperation_id] }}
                </span><span>
                    {{ $v->contact }}
                </span><span>
                    {{ $product_config['tel_type'][$v->tel_type_id] }}: {{ $v->telephone }}
                </span><span>
                    {{date('Y.m.d', strtotime($v->updated_at))}}
                </span>
                </div>
            @endforeach
        </div>
        <div class="business-requirement outsource" style="display: none;">
            <div>
               <span>
                    名称
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
            @foreach($data->CompanyOutsource->where('status', 1) as $v)
                <div>
                   <span>
                          {{ $v->title }}
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
        </div>
        <div class="business-requirement test" style="display: none;">
            <div>
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
            @foreach($data->CompanyOpenTest->where('status', 1) as $v)
                <div>
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
        </div>
        <div class="title-common title-third">
            旗下自研产品
        </div>
        <div class="run-game">
            @foreach($data->companyProductInfo->where('status', 1) as $product)
            <div style="width: 25%;">
                <div class="game-wrapper">
                    <a href="{{ route('product.show', ['id' => $product->id]) }}" class="img-wrapper">
                        <img src="{{ $product->logo }}" />
                    </a>
                    <span class="game-title">{{ $product->title }}</span>
                </div>
            </div>
            @endforeach
        </div>
        <div class="title-common title-third">
            在招职位
        </div>
        @foreach($data->publishJobs->where('status', 1) as $job)
        <div class="search-item-wrapper">
            <div class="search-item">
                <div class="job-detail">
                    <div class="job-detail-title">
                        <a href="{{ route('job.show', ['id' => $job->id]) }}">
                            <span class="title1">{{ $job->title }}</span>
                        </a>
                    </div>
                    <div class="job-detail-requirement">
                        <span class="job-salary">{{$job->salary_start}}-{{$job->salary_end}}元</span>
                        <span class="requirement-item">{{ $province_config[$job->province_code] }}</span>
                        <span class="requirement-item-line">|</span>
                        <span class="requirement-item">{{$jobc['education'][$job['education']]}}</span><span class="requirement-item-line">|</span>
                        <span class="requirement-item">{{$jobc['experience'][$job['experience']]}}</span>
                    </div>
                    <div class="job-detail-info">
                        <p>
                            <i class="iconfont icon-time"></i>
                            <span class="time-info"> {{time_tran($job->updated_at)}}</span>
                        </p>
                        <p>
                            <i class="iconfont icon-email"></i>
                            <span class="email-info">简历接收邮箱：{{$job->companyInfo->resume_receive_email}}</span>
                        </p>
                    </div>
                </div>
                <div class="devide-line"></div>
                <div class="company-detail">
                    <p class="company-detail-title"><a href="{{ route('company.show', ['id' => $job->companyInfo->id]) }}">{{$job->companyInfo->title}}</a></p>
                    <p class="company-detail-nature">{{$job->companyInfo->CompanyTypes($data->position)}}</p>
                    <div class="company-detail-welfare">
                        @foreach ($job->welfareInfo($job->temptation) as $v)
                            <span class="welfare-item">{{$jobc['welfare'][$v]}}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <div class="title-common title-third">
            公司环境
        </div>
        <div class="company-enviroment">
            <!-- Swiper -->
            <div class="swiper-container" id="company-enviroment">
                <div class="swiper-wrapper">
                    @foreach($data->CompanyPhotos as $photo)
                    <div class="swiper-slide" style="width: 200px;"><img src="{{ $photo->url }}"/></div>
                    @endforeach
                </div>
                <!-- 导航按钮 -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </div>
        @else
    <div style="width: 100%;height: 400px;display: block;text-align: center;font-size: 18px;padding-top: 30px;">
        对不起，您所查询的公司不存在，请<a href="javascript:history.back(-1)">重新查询</a>
    </div>

    @endif
@endsection

@section('js')
    <script src="/dist/js/company/company.js"></script>
    <script src="/plugins/layer/layer.js"></script>
    <script>
        document.getElementById("description").style.height = document.getElementById("description").scrollHeight + 10 + "px";
        layer.photos({
            photos: '.company-enviroment .swiper-slide'
            ,anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机（请注意，3.0之前的版本用shift参数）
        });
    </script>
@endsection