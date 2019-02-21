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
                                    <label class="col-md-2 control-label">meta关键词</label>
                                    <div class="col-md-9" >
                                        <input type="text"  class="form-control" name="meta_keywords" value="{{ $about_us_info['meta_keywords'] }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">meta描述</label>
                                    <div class="col-md-9" >
                                        <input type="text"  class="form-control" name="meta_description" value="{{ $about_us_info['meta_description'] }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">关于我们</label>
                                    <div class="col-md-9" >
                                        <textarea  class="form-control" id="description" name="description">{{ $about_us_info['description'] }}</textarea>
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
@section('js')
    <script charset="utf-8" src="/plugins/KindEditor/kindeditor-all-min.js"></script>
    <script charset="utf-8" src="/plugins/KindEditor/lang/zh-CN.js"></script>
    <script type="text/javascript">
        KindEditor.ready(function(K) {
            window.editor = K.create('#description',{
                width:'100%',//宽
                height:'800px',//高
                uploadJson:"{{ route('admin.system.upload') }}",//图片上传地址
                extraFileUploadParams : {"img_path" : 'aboutus', '_token' : "{{csrf_token()}}"},//额外参数
            });
        });
    </script>
@endsection
