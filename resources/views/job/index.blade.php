@extends('public.base')

@section('title','游戏圈招聘')

@section('css')
  <!-- 引入本页样式 -->
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
        <span class="area-item fl">全国</span>
          @foreach ($province as $key => $value)
            @if ($loop->index <11)
             <span class="area-item fl">{{$value}}</span>
          @endif
        @endforeach
        <span class="more fr">更多</span>
      </div>
      <div class="select-area-hover display-none">
        <div class="area-hover-items">
          @foreach ($province as $key => $value)
            @if ($loop->index > 10)
              <span class="area-item fl">{{$value}}</span>
            @endif
          @endforeach
        </div>
      </div>
    </div>
    <div class="select-job">
      <span class="job-title fl">职业：</span>
      <div class="job-items fl">
        @foreach ($jobcategories as $key => $value)
        <span class="job-item">{{$value['title']}}</span>
        @endforeach
      </div>
      @foreach ($jobcategories as $key => $value)
      <div class="items-hover display-none">
        @foreach ($value->child as $item)
        <p class="job-hover-title">{{$item['title']}}</p>
        <div class="job-hover-items">
          @foreach ($item['children'] as $j)
          <span class="hover-item">{{$j['title']}}</span>
          @endforeach
        </div>
        @endforeach
      </div>
      @endforeach
    </div>
    <div class="select-salary">
      <span class="salary-title fl">薪资：</span>
      <div class="salary-items fl">
        <span class="salary-item fl">3000以下</span>
        <span class="salary-item fl">3000-5000</span>
        <span class="salary-item fl">5000-8000</span>
        <span class="salary-item fl">8000-12000</span>
        <span class="salary-item fl">12000-15000</span>
        <span class="salary-item fl">15000-20000</span>
        <span class="salary-item fl">20000以上</span>
      </div>
    </div>
    <div class="select-nature">
      <span class="nature-title fl">性质：</span>
      <div class="nature-items fl">
        @foreach ($job_config['type'] as $key => $value)
        <span class="nature-item fl">{{$value}}</span>
        @endforeach
      </div>
    </div>
    <div class="select-time">
      <span class="time-title fl">时间：</span>
      <div class="time-items fl">
        <span class="time-item fl">一月内</span>
        <span class="time-item fl">二十天内</span>
        <span class="time-item fl">十天内</span>
        <span class="time-item fl">五天内</span>
        <span class="time-item fl">两天内</span>
        <span class="time-item fl">一天内</span>
      </div>
    </div>
    <div class="select-result">
      <div class="selected-items">
        <p class="selected-items-area" @if (!empty($parameter['province_code'])) style="display: flex" @endif>
          <span class="result-area-title">区域：</span>
          <span class="selected-item"><i class="selected-item-content">{{$parameter['province_code']}}</i><i class="iconfont icon-tubiao06"></i></span>
        </p>
        <p class="selected-items-job" @if (!empty($parameter['job_category_id'])) style="display: flex" @endif>
          <span class="result-job-title">职位：</span>
          <span class="selected-item"><i class="selected-item-content">{{$parameter['job_category_id']}}</i><i class="iconfont icon-tubiao06"></i></span>
        </p>
        <p class="selected-items-salary" @if (!empty($parameter['salary'])) style="display: flex" @endif>
          <span class="result-salary-title">薪资：</span>
          <span class="selected-item"><i class="selected-item-content">{{$parameter['salary']}}</i><i class="iconfont icon-tubiao06"></i></span>
        </p>
        <p class="selected-items-nature" @if (!empty($parameter['type'])) style="display: flex" @endif>
          <span class="result-nature-title">性质：</span>
          <span class="selected-item"><i class="selected-item-content">{{$parameter['type']}}</i><i class="iconfont icon-tubiao06"></i></span>
        </p>
        <p class="selected-items-time" @if (!empty($parameter['time'])) style="display: flex" @endif>
          <span class="result-area-title">时间：</span>
          <span class="selected-item"><i class="selected-item-content">{{$parameter['time']}}</i><i class="iconfont icon-tubiao06"></i></span>
        </p>
      </div>
      <div class="select-result-number">
        <p>共找到{{ $jobs->total() }}+职位</p>
      </div>
    </div>
  </div>
  <div class="search-list">
    @foreach ($jobs as $key => $job)
    <div class="search-item-wrapper">
      <div class="search-item">
        <div class="job-detail">
          <div class="job-detail-title">
            <a href="recruit_detail.html">
              <span class="title1">{{$job->title}}</span>
            </a>
          </div>
          <div class="job-detail-requirement">
            <span class="job-salary">{{$job->salary_start}}-{{$job->salary_end}}元</span>
            <span class="requirement-item">{{$job->city_code}}</span>
            <span class="requirement-item-line">|</span>
            <span class="requirement-item">{{$job_config['education'][$job['education']]}}</span><span class="requirement-item-line">|</span>
            <span class="requirement-item">{{$job_config['experience'][$job['experience']]}}</span>
          </div>
          <div class="job-detail-info">
            <p>
              <i class="iconfont icon-time"></i>
              <span class="time-info">
                @if ((time()-strtotime($job->updated_at))/3600 > 12)
                 {{$job->updated_at}}
                  @else
                {{round((time()-strtotime($job->updated_at))/3600)}}小时前更新
                  @endif
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
          <img src="{{$job->companyInfo->logo}}">
          <p class="company-detail-title"><a href="../company/company.html">{{$job->companyInfo->title}}</a></p>
          <p class="company-detail-nature">{{$job->companyInfo->type}}</p>
          <div class="company-detail-welfare">
            @foreach (explode(',', $job->temptation) as $v)
            <span class="welfare-item">{{$job_config['welfare'][$v]}}</span>
            @endforeach
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="holder">
    {{ $jobs->appends($parameter)->links('job.page') }}
  </div>
@endsection
@section('js')
  <!-- 引入本页js文件 -->
  <script src="/dist/js/recruit/recruit.js"></script>
  <script>
      $('.area-item').click(function(){
        var province_code = $(this).text();
        var job_category_id = $('.selected-items-job').children().first().next().children().first().text();
        var salary = $('.selected-items-salary').children().first().next().children().first().text();
        var type = $('.selected-items-nature').children().first().next().children().first().text();
        var time = $('.selected-items-time').children().first().next().children().first().text();
        $.ajax({
          type : "GET",
          url : '{{  route('web.job.index') }}',
          dataType : 'html',
          data:{"province_code" : province_code,'job_category_id' : job_category_id, 'salary' : salary, 'type' : type, 'time' : time},
          success : function(data) {
            $('body').html(data)
          }
        });
      });

        $('.hover-item').click(function(){
          var job_category_id = $(this).text();
          var province_code = $('.selected-items-area').children().first().next().children().first().text();
          var salary = $('.selected-items-salary').children().first().next().children().first().text();
          var type = $('.selected-items-nature').children().first().next().children().first().text();
          var time = $('.selected-items-time').children().first().next().children().first().text();
//          alert(type)
          $.ajax({
            type : "GET",
            url : '{{  route('web.job.index') }}',
            dataType : 'html',
            data:{"province_code" : province_code,'job_category_id' : job_category_id, 'salary' : salary, 'type' : type, 'time' : time},
            success : function(data) {
              $('body').html(data)
            }
          });
        });
      $('.nature-item').click(function(){
        var type = $(this).text();
        var province_code = $('.selected-items-area').children().first().next().children().first().text();
        var salary = $('.selected-items-salary').children().first().next().children().first().text();
        var job_category_id = $('.selected-items-job').children().first().next().children().first().text();
        var time = $('.selected-items-time').children().first().next().children().first().text();
        $.ajax({
          type : "GET",
          url : '{{  route('web.job.index') }}',
          dataType : 'html',
          data:{"province_code" : province_code,'job_category_id' : job_category_id, 'salary' : salary, 'type' : type, 'time' : time},
          success : function(data) {
            $('body').html(data)
          }
        });
      });
      $('.salary-item').click(function(){
        var salary = $(this).text();
        var type = $('.selected-items-nature').children().first().next().children().first().text();
        var province_code = $('.selected-items-area').children().first().next().children().first().text();
        var job_category_id = $('.selected-items-job').children().first().next().children().first().text();
        var time = $('.selected-items-time').children().first().next().children().first().text();
        $.ajax({
          type : "GET",
          url : '{{  route('web.job.index') }}',
          dataType : 'html',
          data:{"province_code" : province_code,'job_category_id' : job_category_id, 'salary' : salary, 'type' : type, 'time' : time},
          success : function(data) {
            $('body').html(data)
          }
        });
      });
  </script>
@endsection

