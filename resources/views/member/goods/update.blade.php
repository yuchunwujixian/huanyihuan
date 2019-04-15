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
                                    @if($userInfo->name)
                                        <p class="form-control-static">{{ $userInfo->name }}</p>
                                        <input type="hidden" name="name" value="{{ $userInfo->name }}">
                                    @else
                                        <input type="text" class="form-control" placeholder="真实姓名" name="name">
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">手机号</label>
                                <div class="col-sm-9">
                                    <p class="form-control-static">
                                        @if($userInfo->mobile)
                                            {{ $userInfo->mobile }}
                                        @else
                                            尚未绑定，<a href="javascript:;" class="text-primary cursor modal-btn" data-name="手机号" data-sms-type="1">点击绑定</a>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">邮箱</label>
                                <div class="col-sm-9">
                                    <p class="form-control-static">
                                        @if($userInfo->email)
                                            {{ $userInfo->email }}
                                        @else
                                            尚未绑定，<a href="javascript:;" class="text-primary cursor modal-btn" data-name="邮箱账号" data-sms-type="2">点击绑定</a>
                                        @endif
                                    </p>
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
    <!-- 模态框（Modal） -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">绑定<span class="username"></span></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-band" role="form">
                        {{ csrf_field() }}
                        <input type="hidden" name="sms-type">
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-1">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></div>
                                    <input name="username" type="text" class="form-control" placeholder="账号" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-1">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="验证码" name="code"  value="{{ old('code') }}">
                                    <a class="btn input-group-addon cursor back-color-blue" id="sendVerifySmsButton">获取验证码</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary username-band">绑定</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
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
        $('.modal-btn').click(function () {
            var _this = $(this);
            var username = _this.attr('data-name');
            var sms_type = _this.attr('data-sms-type');
            $('.username').html(username);
            $('input[name=sms-type]').val(sms_type);
            $('#myModal').modal('show');
        });
        //点击获取验证码进入倒计时
        $('#sendVerifySmsButton').on('click', function() {
            var isTiming = false;
            var _this = $(this);
            var username = $('input[name=username]').val();
            var sms_type = $('input[name=sms-type]').val();//1 手机2邮箱
            //对手机 电子邮件的验证
            if ((sms_type == 1 && mobile_reg.test(username)) || (sms_type == 2 && email_reg.test(username))){
                isTiming = true;
            }else{
                toastr.error('请输入有效的账号');
                return false;
            }
            if (isTiming) {
                _this.removeClass('back-color-blue').addClass('disabled');
                $.ajax({
                    url     : "{{ route('sms.send') }}",
                    type    : 'POST',
                    data    : {username : username, type:3},
                    dataType   : 'json',
                    success : function (data) {
                        if (data.status == 1) {
                            toastr.success(data.message,'');
                            //进入倒计时
                            var second = 60;
                            _this.text(second);
                            var timer = setInterval(function() {
                                second--;
                                if (second > 0) {
                                    _this.text(second);
                                } else {
                                    clearInterval(timer);
                                    isTiming = false;
                                    _this.text("重新获取").removeClass('disabled').addClass('back-color-blue');
                                };
                            },1000);
                        } else {
                            _this.addClass('back-color-blue').removeClass('disabled');
                            toastr.error(data.message,'');
                        }
                    }
                });
            }
        });
        //账号绑定
        $('.username-band').click(function () {
            var isTiming = false;
            var _this = $(this);
            var username = $('input[name=username]').val();
            var sms_type = $('input[name=sms-type]').val();//1 手机2邮箱
            //对手机 电子邮件的验证
            if ((sms_type == 1 && mobile_reg.test(username)) || (sms_type == 2 && email_reg.test(username))){
                isTiming = true;
            }else{
                toastr.error('请输入有效的账号');
                return false;
            }
            if (isTiming) {
                $.ajax({
                    url     : "{{ route('member.info.bandusername') }}",
                    type    : 'POST',
                    data    : $('.form-band').serialize(),
                    dataType   : 'json',
                    success : function (data) {
                        if (data.status == 1) {
                            toastr.success(data.message);
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000)
                        } else {
                            toastr.error(data.message);
                        }
                    }
                });
            }
        })
    </script>
@endsection