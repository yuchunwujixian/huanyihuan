@extends('admin.layouts.base')

@section('title','控制面板')

@section('pageHeader','控制面板')

@section('pageDesc','DashBoard')

@section('content')
    <div class="main animsition">
        <div class="container-fluid">

            <div class="row">
                <div class="">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">编辑职位信息</h3>
                        </div>
                        <div class="panel-body">

                            @include('admin.partials.errors')
                            @include('admin.partials.success')
                            <form class="form-horizontal" role="form" method="POST" action="{{route('admin.job.store')}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <input type="hidden" name="user_id" value="{{ $data->user_id }}">
                                <input type="hidden" name="company_id" value="{{ $data->company_id }}">
                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">职位名称</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="title" value="{{ $data->title }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">所属分类</label>
                                    <div class="col-md-6">
                                        <select class="form-control" name="job_category_id" id="experience">
                                            @foreach($categories as $category)
                                                <option @if($category->id == $data->job_category_id) selected @endif @if($category->depth == 0) disabled @endif>
                                                    @for($i=0;$i<$category->depth;$i++)
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    @endfor
                                                    {{$category->title}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">发布者</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" value="{{ $data->userInfo->name }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">公司名</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" value="{{ $data->companyInfo->title }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="province" class="col-md-3 control-label">公司所在地</label>
                                    <div class="col-md-2">
                                        <select class="form-control" name="province_code" id="province" disabled>
                                            <option value="{{$data->companyInfo->province_code}}">{{$data->companyInfo->province_name}}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select  class="form-control" name="city_code" id="city" disabled>
                                            <option value="{{$data->companyInfo->city_code}}" id="cityOption">{{$data->companyInfo->city_name}}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select  class="form-control" name="area_code" id="area" disabled>
                                            <option value="{{$data->companyInfo->area_code}}" id="cityOption">{{$data->companyInfo->area_name}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">工作经验</label>
                                    <div class="col-md-6">
                                        <select class="form-control" name="experience" id="experience">
                                            <option>请选择</option>
                                            @foreach($jobc['experience'] as $key => $val)
                                                <option value="{{$key}}" @if($data->experience == $key) selected @endif >{{$val}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">薪水开始</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="salary_start" value="{{ $data->salary_start }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">薪水结束</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="salary_start" value="{{ $data->salary_end }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">学历</label>
                                    <div class="col-md-6">
                                        <select class="form-control" name="education" id="education">
                                            <option>请选择</option>
                                            @foreach($jobc['education'] as $key => $val)
                                                <option value="{{$key}}" @if($data->education == $key) selected @endif >{{$val}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">性质</label>
                                    <div class="col-md-6">
                                        <select class="form-control" name="type" id="type">
                                            <option>请选择</option>
                                            @foreach($jobc['type'] as $key => $val)
                                                <option value="{{$key}}" @if($data->type == $key) selected @endif >{{$val}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">福利</label>
                                    <div class="col-md-6">
                                        @foreach($welfare AS $w)
                                            <label class="checkbox-inline">
                                                <input type="checkbox" name="welfare[]" value="{{$w->id}}" @if(in_array($w->id, $data->welfare)) checked @endif> {{$w->title}}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">工作内容</label>
                                    <div class="col-md-6">
                                        <textarea name="work_conntent" class="form-control" rows="8">{{ $data->work_conntent }}</textarea>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">任职要求</label>
                                    <div class="col-md-6">
                                        <textarea name="job_requirements" class="form-control" rows="8">{{ $data->job_requirements }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">具体工作地址</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="work_address" value="{{ $data->work_address }}">
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
                                            <input type="radio" name="status" value="-1" @if($data->status == -1) checked @endif> 已被用户删除
                                        </label>
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
    </div>
@endsection