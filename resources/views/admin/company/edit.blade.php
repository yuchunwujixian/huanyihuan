@extends('admin.layouts.base')

@section('title','控制面板')

@section('pageHeader','控制面板')

@section('pageDesc','DashBoard')

@section('content')

    <div class="main animsition">
        <div class="container-fluid">

            <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">编辑公司信息</h3>
                        </div>
                        <div class="panel-body">
                            @include('admin.partials.errors')
                            @include('admin.partials.success')
                            <form class="form-horizontal" role="form" method="POST" action="{{route('admin.company.store')}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <input type="hidden" name="user_id" value="{{ $data->user_id }}">
                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">名称</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="title" value="{{ $data->title }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="province" class="col-md-3 control-label">公司地址</label>
                                    <div class="col-md-2">
                                        <select class="form-control" name="province_name" id="province">
                                            <option value="">请选择</option>
                                            @forelse ($provinces as $province)
                                                <option value="{{$province->name}}|{{$province->code}}"  data-index="{{$province->code}}" @if($data->province_name == $province->name) selected @endif>{{$province->name}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select  class="form-control" name="city_name" id="city">
                                            <option value="{{$data->city_name}}" id="cityOption">{{$data->city_name}}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select  class="form-control" name="area_name" id="area">
                                            <option value="{{$data->area_name}}" id="cityOption">{{$data->area_name}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">详细地址</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="address" value="{{ $data->address }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">网址</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="url" value="{{ $data->url }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">简历接收邮箱</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="resume_receive_email" value="{{ $data->resume_receive_email }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">公司定位（类型）</label>
                                    <div class="col-md-6">
                                        @foreach ($job_config['company_type'] as $key => $position)
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="company_type[]" value="{{$key}}" @if(in_array($key, $company_type)) checked @endif> {{$position}}
                                        </label>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">电话</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="telephone" value="{{ $data->telephone }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">联系人</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="contact" value="{{ $data->contact }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">公司介绍</label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" rows="10" name="description">{{ $data->description }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">公司logo</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="logo" value="{{ $data->logo }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label"></label>
                                    <div class="col-md-6">
                                        <img src="{{$data->logo}}" width="240px">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">状态</label>
                                    <div class="col-md-6">
                                        <label class="radio-inline">
                                            <input type="radio" name="status" value="1" @if($data->status == 1) checked @endif> 通过
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="status" value="0" @if($data->status == 0) checked @endif> 待审核
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="status" value="2" @if($data->status == 2) checked @endif> 不通过
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">审核理由</label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" rows="10" name="reason">{{ $data->reason or "审核通过" }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-7 col-md-offset-3">
                                        <button type="submit" class="btn btn-primary btn-md">
                                            <i class="fa fa-plus-circle"></i>
                                            保存
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('/dist/js/zone.js')}}"></script>
    <script>zone.address();</script>
@endsection