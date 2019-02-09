@extends('public.base')

@section('title','游戏圈招聘')

@section('css')
  <link rel="stylesheet" href="/dist/css/recruit/recruit.css">
@endsection

@section('content')
  <!-- recruit-banner area -->
  <img class="recruit-banner" src="/dist/img/recruit-banner.png"/>
  <!-- recruit-select area -->
  <div class="select-wrapper">
    <div class="select-area">
      <span class="area-title fl">区域：</span>
      <div class="area-items fl">
        <span class="area-item fl"><a href="{{route('job.index', array('province_code' => 0,'category_id' => $category_id, 'salary' => $salary, 'type' => $type, 'time' => $time))}}">全国</a></span>
          @foreach ($province as $key => $value)
            @if ($loop->index <11)
             <span class="area-item fl"><a href="{{route('job.index', array('province_code' => $key, 'category_id' => $category_id, 'salary' => $salary, 'type' => $type, 'time' => $time))}}">{{$value}}</a></span>
          @endif
        @endforeach
        <span class="more fr">更多</span>
      </div>
      <div class="select-area-hover display-none" style="padding-left: 58px;">
        <div class="area-hover-items">
          @foreach ($province as $key => $value)
            @if ($loop->index > 10)
              <span class="area-item fl"><a href="{{route('job.index', array('province_code' => $key, 'category_id' => $category_id, 'salary' => $salary, 'type' => $type, 'time' => $time))}}">{{$value}}</a></span>
            @endif
          @endforeach
        </div>
      </div>
    </div>
    <div class="select-job">
      <span class="job-title fl">职业：</span>
      <div class="job-items fl">
        <span><a href="{{route('job.index', array('province_code' => $province_code, 'category_id' => 0, 'salary' => $salary, 'type' => $type, 'time' => $time))}}">全部</a></span>
        @foreach ($parent_job_categories as $key => $value)
          <span class="job-item">{{$value->title}}</span>
        @endforeach
      </div>
      @foreach ($categories as $key => $value)
      <div class="items-hover display-none">
        @foreach ($value['child'] as $item)
        <p class="job-hover-title">{{$item->title}}</p>
        <div class="job-hover-items">
          @foreach ($item['children'] as $j)
          <span class="hover-item"><a href="{{route('job.index', array('province_code' => $province_code, 'category_id' => $j->id, 'salary' => $salary, 'type' => $type, 'time' => $time))}}">{{$j['title']}}</a></span>
          @endforeach
        </div>
        @endforeach
      </div>
      @endforeach
    </div>
    <div class="select-salary">
      <span class="salary-title fl">薪资：</span>
      <div class="salary-items fl">
        <span class="salary-item fl"><a href="{{route('job.index', array('province_code' => $province_code, 'category_id' => $category_id, 'salary' => 0,'type' => $type, 'time' => $time))}}">全部</a></span>
        <span class="salary-item fl"><a href="{{route('job.index', array('province_code' => $province_code, 'category_id' => $category_id, 'salary' => '0-3000', 'type' => $type, 'time' => $time))}}">0-3000</a></span>
        <span class="salary-item fl"><a href="{{route('job.index', array('province_code' => $province_code, 'category_id' => $category_id, 'salary' => '3000-5000', 'type' => $type, 'time' => $time))}}">3000-5000</a></span>
        <span class="salary-item fl"><a href="{{route('job.index', array('province_code' => $province_code, 'category_id' => $category_id, 'salary' => '5000-8000', 'type' => $type, 'time' => $time))}}">5000-8000</a></span>
        <span class="salary-item fl"><a href="{{route('job.index', array('province_code' => $province_code, 'category_id' => $category_id, 'salary' => '8000-12000', 'type' => $type, 'time' => $time))}}">8000-12000</a></span>
        <span class="salary-item fl"><a href="{{route('job.index', array('province_code' => $province_code, 'category_id' => $category_id, 'salary' => '12000-15000', 'type' => $type, 'time' => $time))}}">12000-15000</a></span>
        <span class="salary-item fl"><a href="{{route('job.index', array('province_code' => $province_code, 'category_id' => $category_id, 'salary' => '15000-20000', 'type' => $type, 'time' => $time))}}">15000-20000</a></span>
        <span class="salary-item fl"><a href="{{route('job.index', array('province_code' => $province_code, 'category_id' => $category_id, 'salary' => '20000-100000', 'type' => $type, 'time' => $time))}}">20000-100000</a></span>
      </div>
    </div>
    <div class="select-nature">
      <span class="nature-title fl">性质：</span>
      <div class="nature-items fl">
        <span class="time-item fl"><a href="{{route('job.index', array('province_code' => $province_code, 'category_id' => $category_id, 'salary' => $salary, 'type' => 0, 'time' => $time))}}">全部</a></span>
        @foreach ($job_config['type'] as $key => $value)
          <span class="nature-item fl"><a href="{{route('job.index', array('province_code' => $province_code, 'category_id' => $category_id, 'salary' => $salary, 'type' => $key, 'time' => $time))}}">{{$value}}</a></span>
        @endforeach
      </div>
    </div>
    <div class="select-time">
      <span class="time-title fl">时间：</span>
      <div class="time-items fl">
        <span class="time-item fl"><a href="{{route('job.index', array('province_code' => $province_code, 'category_id' => $category_id, 'salary' => $salary, 'type' => $type, 'time' => 0))}}">全部</a></span>
        <span class="time-item fl"><a href="{{route('job.index', array('province_code' => $province_code, 'category_id' => $category_id, 'salary' => $salary, 'type' => $type, 'time' => '30'))}}"> 一月内</a></span>
        <span class="time-item fl"><a href="{{route('job.index', array('province_code' => $province_code, 'category_id' => $category_id, 'salary' => $salary, 'type' => $type, 'time' => '20'))}}"> 二十天内</a></span>
        <span class="time-item fl"><a href="{{route('job.index', array('province_code' => $province_code, 'category_id' => $category_id, 'salary' => $salary, 'type' => $type, 'time' => '10'))}}"> 十天内</a></span>
        <span class="time-item fl"><a href="{{route('job.index', array('province_code' => $province_code, 'category_id' => $category_id, 'salary' => $salary, 'type' => $type, 'time' => '5'))}}"> 五天内</a></span>
        <span class="time-item fl"><a href="{{route('job.index', array('province_code' => $province_code, 'category_id' => $category_id, 'salary' => $salary, 'type' => $type, 'time' => '2'))}}"> 两天内</a></span>
        <span class="time-item fl"><a href="{{route('job.index', array('province_code' => $province_code, 'category_id' => $category_id, 'salary' => $salary, 'type' => $type, 'time' => '1'))}}"> 一天内</a></span>
      </div>
    </div>
    <style>
      .select-result .selected-items p {display: flex}
    </style>
    <div class="select-result">
      <div class="selected-items">
        @if($province_code)
        <p class="selected-items-area" >
          <span class="result-area-title">区域：</span>
          <span class="selected-item">
            <i class="selected-item-content">{{$province_name}}</i>
            <i class="iconfont icon-tubiao06"></i>
          </span>
        </p>
        @endif
        @if($category_id)
        <p class="selected-items-job">
          <span class="result-job-title">职位：</span>
          <span class="selected-item"><i class="selected-item-content">{{$category_name}}</i><i class="iconfont icon-tubiao06"></i></span>
        </p>
          @endif
          @if($salary)
        <p class="selected-items-salary" >
          <span class="result-salary-title">薪资：</span>
          <span class="selected-item"><i class="selected-item-content">{{$salary_name}}</i><i class="iconfont icon-tubiao06"></i></span>
        </p>
          @endif
          @if($type)
        <p class="selected-items-nature">
          <span class="result-nature-title">性质：</span>
          <span class="selected-item"><i class="selected-item-content">{{$type_name}}</i><i class="iconfont icon-tubiao06"></i></span>
        </p>
          @endif
          @if($time)
        <p class="selected-items-time" >
          <span class="result-area-title">时间：</span>
          <span class="selected-item"><i class="selected-item-content">{{$time_name}}</i><i class="iconfont icon-tubiao06"></i></span>
        </p>
          @endif
      </div>
      <div class="select-result-number">
        @if($total)
        <p>共找到{{ $total }}职位</p>
          @endif
      </div>
    </div>
  </div>
  <div class="search-list">
    @foreach ($lists as $key => $job)
    <div class="search-item-wrapper">
      <div class="search-item">
        <div class="job-detail">
          <div class="job-detail-title">
            <a href="{{route('job.show', array('id' => $job->id))}}">
              <span class="title1">{{$job->title}}</span>
            </a>
          </div>
          <div class="job-detail-requirement">
            <span class="job-salary">{{$job->salary_start}}-{{$job->salary_end}}元</span>
            <span class="requirement-item">{{ $province_config[$job->province_code] }}</span>
            <span class="requirement-item-line">|</span>
            <span class="requirement-item">{{$job_config['education'][$job['education']]}}</span><span class="requirement-item-line">|</span>
            <span class="requirement-item">{{$job_config['experience'][$job['experience']]}}</span>
          </div>
          <div class="job-detail-info">
            <p>
              <i class="iconfont icon-time"></i>
              <span class="time-info">
                 {{time_tran($job->updated_at)}}
              </span>
            </p>
            <p>
              <i class="iconfont icon-email"></i>
              <span class="email-info">简历接收邮箱：{{$job->companyInfo->resume_receive_email}}</span>
            </p>
          </div>
        </div>
        <div class="devide-line"></div>
        <div class="company-detail">
          <img width="120px" height="120px" src="{{$job->companyInfo->logo}}">
          <p class="company-detail-title"><a href="{{ route('company.show', ['id' => $job->companyInfo->id]) }}">{{$job->companyInfo->title}}</a></p>
          <p class="company-detail-nature">
            {{$job->companyInfo->CompanyTypes('1,2,3')}}
          </p>
          <div class="company-detail-welfare">
            @foreach ($job->welfareInfo($job->temptation) as $v)
            <span class="welfare-item">{{$job_config['welfare'][$v]}}</span>
            @endforeach
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="holder">
  </div>
@endsection
@section('js')
  <script src="/dist/js/recruit/recruit.js"></script>
@endsection

