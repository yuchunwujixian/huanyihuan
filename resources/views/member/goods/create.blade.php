@extends('public.base')

@section('title', $title)

@section('uc_here', $uc_here)

@section('css')
    <link rel="stylesheet" type="text/css" href="/plugins/bootstrap-fileinput/css/fileinput.min.css">
    <link rel="stylesheet" href="/dist/css/member/common.css">
    <style>
        .price{
            position: relative;
        }
        .price:after{
            position: absolute;
            top: 0;
            content:"aaaa";
            right: 18px;
        }
    </style>
@endsection

@section('content')
    @include('public.member_header')
    <div class="container">
        <div class="row">
            <div class="col-sm-4 hidden-xs">
                @include('public.member_left')
            </div>
            <div class="col-xs-1 visible-xs"></div>
            <div class="col-xs-10 col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" id="form">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-sm-2 control-label">商品名称</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="商品名称" name="title" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">商品标题</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="商品名称" name="long_title" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">商品分类</label>
                                <div class="col-sm-10">
                                    <select class="form-control selectpicker" name="category_id" data-width="false">
                                        <option value="0">--请选择--</option>
                                        @foreach($categories as $v)
                                            <option value="{{$v->id}}" @if($v->parent_id == 0)disabled @endif>
                                                @for($i=0;$i<$v->depth;$i++)
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                @endfor
                                                {{$v->title}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">商品主图</label>
                                <div class="col-sm-10">
                                    <input id="upload_photo" class="form-control" type="file" value="本地上传" name="file"/>
                                    <input type="hidden" name="img_url"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">商品数量</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" placeholder="商品数量" name="num">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">商品价值</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control price" placeholder="商品价值" name="price">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">个人说明</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="3" placeholder="个人说明" name="description"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10 text-right">
                                    <button type="button" class="btn btn-default save-data">保存</button>
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
    <script src="/plugins/bootstrap-fileinput/js/fileinput.min.js"></script>
    <script src="/plugins/bootstrap-fileinput/js/locales/zh.js"></script>
    <script>
        $("#upload_photo").fileinput({
            language: 'zh', //设置语言
            uploadUrl:'{{ route('upload.file') }}',
            enctype: 'multipart/form-data',
            allowedFileExtensions : ['jpg', 'png','bmp','jpeg'],//接收的文件后缀
            showUpload: false, //是否显示上传按钮
            showPreview: false, //展前预览
            showCaption: true,//是否显示标题
            maxFileSize : 10000,//上传文件最大的尺寸
            maxFileCount: 1,
            buttonLabelClass: '',
            browseClass: "btn btn-primary", //按钮样式
            uploadAsync: true,
            allowedPreviewTypes: ['image'],
            uploadExtraData:{target:'goods'}
        }).on('fileerror', function(event, data, msg) {  //一个文件上传失败
            toastr.error('文件上传失败！'+msg);
        }).on("fileuploaded", function(event, data, previewId, index) {
            data = data.response;
            if (data.status == 1){
                $('.member-avatar').attr('src', data.path);
                $('input[name=avatar]').val(data.path);
            }else{
                toastr.error(data.message);
            }
        }).on('fileclear', function (event, previewId) {
            $('.member-avatar').attr('src', avatar);
            $('input[name=avatar]').val('');
        }).on('filebatchselected', function (event, files) {//选中文件事件
            $(this).fileinput("upload");
        }).on("filecleared",function(event, data, msg){
            $('.member-avatar').attr('src', avatar);
            $('input[name=avatar]').val('');
        }).on('filedeleted', function(event, key) {
            $('.member-avatar').attr('src', avatar);
            $('input[name=avatar]').val('');
        });
        $('.save-data').click(function () {
            $.ajax({
                url:'{{ route('member.info.store') }}',
                data:$('#form').serialize(),
                dataType: 'JSON',
                'type':'POST',
                success: function (data) {

                    if (data.status == 1){
                        toastr.success(data.message);
                    }else{
                        toastr.error(data.message);
                    }
                },
                error:function (xhr) {
                    toastr.error('系统繁忙，请重试');
                }
            })
        })
    </script>
@endsection