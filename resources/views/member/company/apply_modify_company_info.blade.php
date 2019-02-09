@extends('public.base')

@section('title','用户中心-公司信息')

@section('uc_here', '公司信息')

@section('css')
  <link rel="stylesheet" href="/dist/css/personal/personal.css">
  <link rel="stylesheet" href="/dist/css/personal/companyinfo.css">
@endsection

@section('content')
  @include('public.member_header')

  <div id="loading">
    <div id="loading-center">
      <div id="loading-center-absolute">
        <div class="object" id="object_four"></div>
        <div class="object" id="object_three"></div>
        <div class="object" id="object_two"></div>
        <div class="object" id="object_one"></div>
      </div>
    </div>
  </div>

  <!-- 内容部分 -->
  <div class="wrapper">
    @include('public.member_left')
    <div class="right-content">
      <form action="{{Route('member.company.store.apply.modify.info')}}" method="post" class="user-info-input">
      {{csrf_field()}}
        <input type="hidden" name="user_id" value="{{$user_id}}">
        <input type="hidden" name="company_id" value="{{$company_id}}">
      <div class="input-content" style="border-bottom:none">
        <div class="form-item">
        <div class="company-title" style="padding-left: 0px">申请理由</div>
        <textarea name="reason" rows="15" cols="80"></textarea>
        <input type="submit" class="save-btn" style="margin-bottom: 10px;" value="提交申请" />
      </div>
      </div>
    </form>
    </div>
  </div>
@endsection