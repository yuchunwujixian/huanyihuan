@extends('public.base')

@section('title','首页')

@section('css')
  <link rel="stylesheet" href="/dist/css/index.css">
  <style>
    .type-search{
      float: left;
      height: 42px;
      margin: 4px 0 0 5px;
      background-color: rgba(255, 255, 255, 0.8);
      border: none;
      width: 72px;
    }
    .type-search > option{
      line-height: 42px;
    }
    .gametype-more-show>a>span {
      display: inline-block;
      vertical-align: top;
      margin-left: 22px !important;
      cursor: pointer;
    }
  </style>
@endsection

@section('content')
  <!-- banner图 -->
  <div class="banner">
    <img src="{{asset('dist/img/connect-banner.png')}}">
    <form action="{{ route('search.index') }}" method="post" name="form" class="form">
      {{csrf_field()}}
    <div class="search-wrapper">
      <select class="type-search" name="type_search">
        <option value="1">找公司</option>
        <option value="2">找产品</option>
        {{--<option value="3">找联系人</option>--}}
      </select>
      <input type="text" placeholder="找公司/找产品" style="width: 300px;" name="condition">
      <div class="search">
        <img src="{{asset('dist/img/search.png')}}" class="search-icon" onclick="javascript:{document.forms['form'].submit();}">
      </div>
      @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
          <div id="textInfo-error" class="error" style="text-align: center;margin-top: 60px;color: red">{{$error}}</div>
        @endforeach
      @endif
    </div>
  </form>
  </div>
  <!-- container -->
  <div class="content">
    <div class="container">
      <div class="one-select">
        <span>类型：</span>
        @foreach($product_config['company_type'] as $key => $value)
          <a href="{{route('company.index')}}?position={{ $key }}&province_code={{$province_code}}">
            <span @if($key == $position) class="type project-type active" @else class="type project-type" @endif>
                       {{ $value }}
             </span>
          </a>
        @endforeach
      </div>
      {{--<div id="projct-children" style="display: none">--}}
        {{--<div id="developer" style="display: none">--}}
          {{--<span class="type"><a href="{{route('company.index')}}?type=product&class=company">公司</a></span>--}}
          {{--<span class="type"><a href="{{route('company.index')}}?type=product&class=company">创业团队</a></span>--}}
          {{--<span class="type"><a href="{{route('company.index')}}?type=product&class=company">工作室</a></span>--}}
          {{--<span class="type"><a href="{{route('company.index')}}?type=product&class=company">个人开发者</a></span>--}}
        {{--</div>--}}
        {{--<div id="publisher" style="display: none">--}}
          {{--<span class="type"><a href="#">国内</a></span>--}}
          {{--<span class="type"><a href="#">海外</a></span>--}}
        {{--</div>--}}
        {{--<div id="channel" style="display: none">--}}
          {{--<span class="type"><a href="#">IOS越狱渠道</a></span>--}}
          {{--<span class="type"><a href="#">安卓渠道</a></span>--}}
          {{--<span class="type"><a href="#">H5渠道</a></span>--}}
        {{--</div>--}}
        {{--<div id="media" style="display: none">--}}
          {{--<span class="type"><a href="#">受众群众（玩家）</a></span>--}}
          {{--<span class="type"><a href="#">受众群众（企业）</a></span>--}}
        {{--</div>--}}
        {{--<div id="outsource" style="display: none">--}}
          {{--<span class="type"><a href="#">程序外包</a></span>--}}
          {{--<span class="type"><a href="#">美术外包</a></span>--}}
          {{--<span class="type"><a href="#">动画外包</a></span>--}}
          {{--<span class="type"><a href="#">音乐外包</a></span>--}}
          {{--<span class="type"><a href="#">测试外包</a></span>--}}
          {{--<span class="type"><a href="#">资质外包</a></span>--}}
          {{--<span class="type"><a href="#">三方支付</a></span>--}}
        {{--</div>--}}
      {{--</div>--}}
      <div class="one-select">
        <span>地区：</span>
        @foreach($province_config as $key => $value)
          @if ($loop->index < 13)
            <a href="?position={{$position}}&province_code={{$key}}">
            <span @if($key == $province_code) class="region active" @else class="region" @endif>
                    {{ $value }}
            </span>
            </a>
          @endif
        @endforeach
        <span class="gametype-more">更多</span>
        <div class="gametype-more-show" style="display: none;padding-left:46px;">
          @foreach($province_config as $key => $value)
            @if ($loop->index > 12)
              <a href="?position={{$position}}&province_code={{$key}}">
                <span @if($key == $province_code) class="region active" @else class="region" @endif>
                      {{ $value }}
                 </span>
              </a>
            @endif
          @endforeach
        </div>
      </div>
      @if($position || $province_code)
      <div id="parameter-show">
        已选条件：
        @if($position)
        <div class="inline-block parameter-show">
          <span>类型：</span><span class="one-parameter" name="type" onclick="window.location.href='{{route('company.index')}}?position=0&province_code={{$province_code}}'"><i>{{ $product_config['company_type'][$position] }}</i> ×</span>
        </div>
        @endif
        @if($province_code)
          <div class="inline-block parameter-show">
            <span>地区：</span><span class="one-parameter" name="region" onclick="window.location.href='{{route('company.index')}}?position={{ $position }}&province_code=0'"><i>{{ $province_config[$province_code] }}</i> ×</span>
          </div>
        @endif
      </div>
      @endif
      <div id="search-show">
        <style>
          table {border-collapse: collapse; width: 100%}
          table, th, td {border: 1px solid #DDD}
          th, td {height: 30px; vertical-align: middle; padding: 5px}
        </style>
        <table>
          <tbody >
            <th width="220px">公司名称</th>
            <th width="150px">联系人</th>
            <th width="200px">主营业务</th>
            <th width="180px">旗下产品</th>
            <th width="120px">官网详情</th>
          </tbody>
          <tbody>
            @foreach($lists as $company)
            <tr>
              <td><a href="{{route('company.show', ['id' => $company->id])}}">{{$company->title}}</a></td>
              <td>{{$company->contact}}</td>
              <td>{{$company->CompanyTypes($company->position)}}</td>
              <td>{{$company->companyProductInfo()->count()}}歀产品</td>
              <td><a href="{{$company->url}}" target="_blank">{{$company->url}}</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="holder">
        {{$lists->appends(['position' => $position])->links()}}
      </div>
    </div>
  </div>

@endsection

@section('js')
    <script src="/dist/js/index.js"></script>
    <script>
      $().ready(function () {
        // 在键盘按下并释放及提交后验证提交表单
        $(".form").validate({
          rules: {
            condition: "required"
          },
          messages: {
            condition: "请输入信息"
          }
        });
      });
    </script>
@endsection