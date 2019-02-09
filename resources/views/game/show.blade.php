@extends('public.base')

@section('title','游戏详情')

@section('css')
  <!-- 引入本页样式 -->
  <link rel="stylesheet" href="/dist/css/game/game.css">
@endsection

@section('content')
  <!-- 中部内容区域 -->
  <div class="game-wrapper">
    <div class="game-item">
      <div class="game-info">
        <p class="item-title">游戏</p>
        <div class="product-wrapper">
          <div class="product-img-wrapper">
            <img src="{{ $game_info->img }}">
          </div>
          <div class="product-info">
            <p>
              <span>游戏名称：</span>
              <span>《{{ $game_info->title }}》</span>
            </p>
            <p>
              <span>平&nbsp;&nbsp;&nbsp;&nbsp;台：</span>
              <span>{{ $game_info->icon }}</span>
            </p>
            <p>
              <span>类&nbsp;&nbsp;&nbsp;&nbsp;型：</span>
              <span>{{ $game_config['game_type'][$game_info->type_id] }}</span>
            </p>
            <p>
              <span>研发公司：</span>
              <span>{{ $game_info->company }}</span>
            </p>
            <p>
              <span>运营公司：</span>
              <span>{{ $game_info->companyInfo->title }}</span>
            </p>
            <p>
              <span>下载地址：</span>
              <span>{{ $game_info->url }}</span>
            </p>
          </div>
        </div>
      </div>
      <div class="game-goal">
        <p class="item-title">需求目标</p>
        <div class="goal-wrapper">
          <textarea style="width: 95%;height: 96%;overflow-x: hidden;overflow-y: hidden;resize: none;border: 0;background-color: white" disabled>{{ $game_info->needs }}</textarea>
        </div>
      </div>
      <div class="game-cooperation">
        <p class="item-title">合作区域及备注</p>
        <div class="cooperation-wrapper">
          <div class="row-title">
            <span>需求</span>
            <span>合作类型</span>
            <span>合作地区</span>
            <span>合作区域备注</span>
          </div>
          @foreach ($game_info->gameAreaInfo as $value)
          <div class="row-content">
            <span>{{ $value->needs }}</span>
            <span>{{ $value->type }}</span>
            <span>{{ $value->title }}</span>
            <span>{{ $value->content }}</span>
          </div>
          @endforeach
        </div>
      </div>
      <div class="game-contact">
        <p class="item-title">联系人</p>
        <ul>
          <li class="research contact-active">研发方</li>
          <li class="operate">运营方</li>
        </ul>
        <div class="research-wrapper">
          <div class="row-title">
            <span>姓名</span>
            <span>职务</span>
            <span>负责区域</span>
            <span>负责事宜</span>
            <span>联系方式</span>
          </div>
          @foreach ($game_info->gameContact->where('type', 1) as $value)
          <div class="row-content">
            <span>{{ $value->name }}</span>
            <span>{{ $value->job }}</span>
            <span>{{ $value->area }}</span>
            <span>{{ $value->charge }}</span>
            <span>{{ $value->tel_phone }}</span>
          </div>
          @endforeach
        </div>
        <div class="operate-wrapper" style="display: none">
          <div class="row-title">
            <span>姓名</span>
            <span>职务</span>
            <span>负责区域</span>
            <span>负责事宜</span>
            <span>联系方式</span>
          </div>
          @foreach ($game_info->gameContact->where('type', 0) as $value)
            <div class="row-content">
              <span>{{ $value->name }}</span>
              <span>{{ $value->job }}</span>
              <span>{{ $value->area }}</span>
              <span>{{ $value->charge }}</span>
              <span>{{ $value->tel_phone }}</span>
            </div>
          @endforeach
        </div>
      </div>
      <div class="game-introduce">
        <p class="item-title">游戏介绍</p>
        <div class="introduce-wrapper">
          <textarea style="width: 95%;height: 96%;overflow-x: hidden;overflow-y: hidden;resize: none;border: 0;background-color: white" disabled>{{ $game_info->content }}</textarea>
        </div>
      </div>
      <div class="game-screenshot">
        <p class="item-title">游戏截图</p>
        <div class="screenshot-wrapper">
          <div class="swiper-container">
            <div class="swiper-wrapper">
              @foreach ($game_info->gamePhotoInfo->chunk(4) as $chunks)
              <div class="swiper-slide">
                @foreach ($chunks as $value)
                <div class="aaa">
                  <a href="javascript:void(0);" class="img-wrapper">
                    <img src="{{ $value->url }}"/>
                  </a>
                  <span class="game-title">{{ $game_info->title }}</span>
                </div>
                @endforeach
              </div>
              @endforeach
            </div>
            <!-- 导航按钮 -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('js')
  <!-- 引入本页js文件 -->
  <script src="/dist/js/swiper-3.4.2.jquery.min.js"></script>
  <script>
    $(document).ready(function () {
      var mySwiper = new Swiper ('.swiper-container', {
        direction: 'horizontal',
        loop: true,
        // 如果需要前进后退按钮
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev'
      });
    })
  </script>
@endsection

