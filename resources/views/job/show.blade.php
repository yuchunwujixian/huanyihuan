@extends('public.base')

@section('title','招聘详情页')

@section('css')
  <link rel="stylesheet" href="/dist/css/recruit/recruit_detail.css">
@endsection

@section('content')
  <!-- recruit-banner area -->
  <img class="recruit-banner" src="/dist/img/recruit-banner.png"/>
  <!-- search-item area -->
  <div class="search-item-wrapper">
    <div class="search-item">
      <div class="item-detail">
        <div class="job-detail">
          <div class="job-detail-title">
            <span class="title1">{{ $data->title }}</span>
          </div>
          <div class="job-detail-requirement">
            <span class="job-salary">{{ $data->salary_start }}-{{ $data->salary_end }}元</span>
            <span class="job-year">{{ $job_config['experience'][$data->experience] }}</span>
            <div class="job-publish-time">发布时间：{{time_tran($data->updated_at)}}</div>
          </div>
          <div class="job-detail-welfare">
            @foreach ($data->welfareInfo($data->temptation) as $v)
              <span class="welfare-item">{{$job_config['welfare'][$v]}}</span>
            @endforeach
          </div>
        </div>
        <div class="company-detail">
          <h2>公司介绍</h2>
          <p>
            <i class="iconfont icon-home"></i>
            <span>{{$data->companyInfo->title}}</span>
          </p>
          <p>
            <i class="iconfont icon-location"></i>
            <span>公司地址：{{$data->companyInfo->address}}</span>
          </p>
          <p>
            <i class="iconfont icon-ie"></i>
            <span>公司网址：{{$data->companyInfo->url}}</span>
          </p><p>
            <i class="iconfont icon-email"></i>
            <span>简历接收邮箱：{{$data->companyInfo->resume_receive_email}}</span>
          </p>
        </div>
      </div>
      <div class="content-other">
        <div class="content-wrapper">
          <div class="job-content" style="margin-top: 25px">
            <h2>工作内容：</h2>
            <div style="line-height: 25px">
              {{ $data->work_conntent }}
            </div>
          </div>
          <div class="job-content" style="margin-top: 25px">
            <h2>任职要求：</h2>
            <div style="line-height: 25px">
              {{ $data->job_requirements }}
            </div>
          </div>
        </div>
        <div class="other-job">
          <h2>其他职位：</h2>
          <ul>
            @foreach ($all_of_jobs as $value)
            <li><a href="{{ route('job.show', ['id' => $value['id']]) }}">{{ $value['title'] }} | {{ $value['salary_start'] }}-{{ $value['salary_end'] }}元 | {{ $job_config['education'][$data->education] }} | {{ $job_config['experience'][$value->experience] }}</a></li>
            @endforeach
          </ul>
        </div>

      </div>
    </div>
  </div>
  <div class="container">
    <div class="title-common title-third">
      公司介绍
    </div>
    <div class="company-enviroment" style="height: 240px;margin-top: 20px;margin-left: 20px">
      <!-- Swiper -->
      {{$data->companyInfo->description}}
    </div>
  </div>
  <div class="container">
    <div class="title-common title-third">
      公司环境
    </div>
    <div class="company-enviroment">
      <!-- Swiper -->
      <div class="swiper-container" id="company-enviroment">
        <div class="swiper-wrapper">
          @foreach ($company_photos as $value)
          <div class="swiper-slide" style="width: 200px;"><img src="{{ $value['url'] }}" /></div>
          @endforeach
        </div>
        <!-- 导航按钮 -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
      </div>
    </div>
  </div>
@endsection
@section('js')
  <script>
    $(document).ready(function () {
      $('.search-item-wrapper').height($('.search-item-wrapper .search-item').height());
      // 公司环境
      var swiper = new Swiper('#company-enviroment', {
        effect: 'coverflow',
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: 3,
        loop: true,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        coverflow: {
          rotate: 0,
          stretch: 0,
          depth: 150,
          modifier: 1,
          slideShadows : false
        }
      });
    })
  </script>
@endsection
