@extends('admin.layouts.base')

@section('title','职位详情')

@section('pageHeader','职位详情')

@section('pageDesc','DashBoard')

@section('content')
<div class="row">
    <h3 class="panel-title text-center"><a href="{{ route('admin.jobcategory.index') }}" style="color: #31708f">查看分类</a></h3>
    <div class="panel-body">
        @include('admin.partials.errors')
        @include('admin.partials.success')
        <form class="form-horizontal" role="form" method="post" action="{{ route('admin.job.category.save') }}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{ $id }}">
            @include('admin.jobcategory._form')
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
@stop