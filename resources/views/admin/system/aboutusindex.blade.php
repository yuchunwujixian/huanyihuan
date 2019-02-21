@extends('admin.layouts.base')

@section('title', $title)

@section('content')
    <div class="main animsition">
        <div class="container-fluid">
            <div class="row">
                <div class="">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">编辑{{ $title }}信息</h3>
                        </div>
                        <div class="panel-body">
                            @include('admin.partials.errors')
                            @include('admin.partials.success')
                            <form class="form-horizontal" role="form" method="POST" action="{{route('admin.system.aboutus_store')}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" value="{{ $about_us_info['id'] }}">
                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">企业介绍</label>
                                    <div class="col-md-5" >
                                        <textarea  class="form-control" id="description" name="description" rows="10" cols="100">{{ $about_us_info['description'] }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tag" class="col-md-3 control-label">提供服务</label>
                                    <div class="col-md-5">
                                        <textarea class="form-control" name="service" cols="100" rows="5" placeholder="服务之间用空格隔开...">{{ $about_us_info['service'] }}</textarea>
                                        <em>注意：务必一行一个服务</em>
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
