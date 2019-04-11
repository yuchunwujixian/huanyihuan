@extends('public.base')

@section('title', $title)

@section('uc_here', $uc_here)

@section('css')
    <link rel="stylesheet" type="text/css" href="/plugins/bootstrap-fileinput/css/fileinput.min.css">
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
                            <input name="avatar" type="hidden"/>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">上传头像</label>
                                <div class="col-sm-9">
                                    <input id="upload_photo" class="form-control" type="file" value="本地上传" name="file"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">昵称</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="昵称" name="nickname" value="{{ $userInfo->nickname }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">真实姓名</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="真实姓名" name="name" value="{{ $userInfo->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">手机号</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="手机号" name="mobile" value="{{ $userInfo->mobile }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">邮箱</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="邮箱" name="email" value="{{ $userInfo->email }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">个人等级</label>
                                <div class="col-sm-9">
                                    <p class="form-control-static">{{ $userInfo->level }}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">个人积分</label>
                                <div class="col-sm-9">
                                    <p class="form-control-static">{{ $userInfo->integral }}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">个人说明</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" rows="3" placeholder="个人说明" name="description">{{ $userInfo->description }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9 text-right">
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
        var avatar = '';
        setTimeout(function () {
            avatar = $('.member-avatar').attr('src');
        }, 500);
        $("#upload_photo").fileinput({
            language: 'zh', //设置语言
            uploadUrl:'{{ route('member.upload.images') }}',
            enctype: 'multipart/form-data',
            allowedFileExtensions : ['jpg', 'png','bmp','jpeg'],//接收的文件后缀
            showUpload: true, //是否显示上传按钮
            showPreview: false, //展前预览
            showCaption: true,//是否显示标题
            maxFileSize : 10000,//上传文件最大的尺寸
            maxFileCount: 1,
            buttonLabelClass: '',
            browseClass: "btn btn-primary", //按钮样式
            uploadAsync: true,
            allowedPreviewTypes: ['image'],
            uploadExtraData:function (previewId, index) {
                //向后台传递type,nameStr作为额外参数
                var obj = {};
                obj.path = "member";
                obj.type = "avatar";
                return obj;
            }
        }).on('fileerror', function(event, data, msg) {  //一个文件上传失败
            toastr.error('文件上传失败！'+msg);
        }).on("fileuploaded", function(event, data, previewId, index) {
            data = data.response;
            if (data.status == 1){
                $('.member-avatar').attr('src', '/storage/' + data.path);
                $('input[name=avatar]').val(data.path);
            }else{
                toastr.error(data.message);
            }
        }).on('fileclear', function (event, previewId) {
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