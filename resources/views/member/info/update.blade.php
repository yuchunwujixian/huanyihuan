@extends('public.base')

@section('title','关于我们')

@section('uc_here', '基本资料')

@section('css')
    <link rel="stylesheet" href="/dist/css/personal/personal.css">
    <link rel="stylesheet" href="/dist/css/personal/basicinfo.css">
@endsection

@section('content')
    @include('public.member_header')
    <!-- 内容部分 -->
    <div class="wrapper">
        @include('public.member_left')
        <div class="right-content">
            <form action="{{route('member.info.store')}}" id="signupForm" method="post" class="user-info-input">
                {{csrf_field()}}
                <input type="hidden" value="{{$data->id}}" name="id">
                <div class="input-content">

                    <div class="form-item">
                        <div class="left-form">头像</div>
                        <div class="right-form">
                            <input id="upload_photo" class="upload_button" type="button" value="本地上传"/>
                            <input type="hidden" name="avatar_url">
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="left-form">邮箱账号</div>
                        <div class="right-form">
                            <input class="user-phone" readonly type="text" value="{{$data->email}}" />
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="left-form">所在公司</div>
                        <div class="right-form company">
                            @if($data->companyInfo)
                                {{$data->companyInfo->title}}
                            @else
                                <input name="company" type="text" placeholder="例如：北京炯米互联有限公司" style="width: 400px;display: inline-block"/>
                                <div style="width: 50px;text-align: center;display: inline-block;cursor: pointer" id="company_add">添加</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="left-form">姓名</div>
                        <div class="right-form">
                            <input id="user_name" name="name" type="text" placeholder="例如：王震" value="{{$data->name}}"/>
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="left-form">部门</div>
                        <div class="right-form">
                            <input id="user_department" name="department" type="text" placeholder="例如：策划部" value="{{$data->department}}"/>
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="left-form">职务</div>
                        <div class="right-form">
                            <input id="user_duties" name="position" type="text" placeholder="例如：文案策划" value="{{$data->position}}"/>
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="left-form">负责区域</div>
                        <div class="right-form">
                            <input id="user_eare" name="manage_area" type="text" placeholder="例如：华东" value="{{$data->manage_area}}"/>
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="left-form">负责事宜</div>
                        <div class="right-form">
                            <textarea id="user_thing" name="manage_matters" type="text" placeholder="说明一下自己的职责">{{$data->manage_matters}}</textarea>
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="left-form">手机号</div>
                        <div class="right-form">
                            <input type="text" name="mobile" value="{{$data->mobile}}" placeholder="请输入你的手机号" />
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="left-form">个人说明</div>
                        <div class="right-form">
                            <textarea name="description" placeholder="你的自我说明">{{$data->description}}</textarea>
                        </div>
                    </div>
                </div>
                {{--<div class="user-optional-info">--}}
                    {{--<div class="user-item-title">--}}
                        {{--其他资料（选填）--}}
                    {{--</div>--}}
                    {{--<div class="option-info-content">--}}
                        {{--<div class="left-form">手机号</div>--}}
                        {{--<div class="right-form">--}}
                            {{--<input type="text" name="mobile" value="{{$data->mobile}}" placeholder="请输入你的手机号" />--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="option-info-content">--}}
                        {{--<div class="left-form">个人说明</div>--}}
                        {{--<div class="right-form">--}}
                            {{--<textarea name="description" placeholder="你的自我说明">{{$data->description}}</textarea>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="user-item-title">--}}
                        {{--社交账号--}}
                    {{--</div>--}}
                    {{--<div class="user-social-account">--}}
                        {{--<div class="social-content-item">--}}
                            {{--<div class="account-type">--}}
                                {{--<i class="icon iconfont icon-QQ QQ"></i>QQ--}}
                            {{--</div>--}}
                            {{--<div class="account-name">--}}
                                {{--雪花纷飞--}}
                            {{--</div>--}}
                            {{--<button class="account-relieve account-btn">立即解绑</button>--}}
                        {{--</div>--}}
                        {{--<div class="social-content-item">--}}
                            {{--<div class="account-type">--}}
                                {{--<i class="icon iconfont icon-weibiaoti1 wechat"></i>微信--}}
                            {{--</div>--}}
                            {{--<div class="account-name">--}}

                            {{--</div>--}}
                            {{--<button class="account-bind account-btn">立即绑定</button>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <input type="submit" class="save-btn" value="保存" />
            </form>
        </div>
    </div>

@endsection

@section('js')
    <script src="/dist/js/personal/basicinfo.js"></script>
    <link rel="stylesheet" type="text/css" href="/plugins/uploadify_3.2.1/uploadify.css">
    <script type="text/javascript" src="/plugins/uploadify_3.2.1/jquery.uploadify.js"></script>
    <script>
        var uploadify_onSelectError = function(file, errorCode, errorMsg) {
            var msgText = "上传失败\n";
            switch (errorCode) {
                case SWFUpload.QUEUE_ERROR.QUEUE_LIMIT_EXCEEDED:
                    //this.queueData.errorMsg = "每次最多上传 " + this.settings.queueSizeLimit + "个文件";
                    msgText += "每次最多上传 " + this.settings.uploadLimit + "个文件";
                    break;
                default:
                    msgText += "错误代码：" + errorCode + "\n" + errorMsg;
            }
            alert(msgText);
        };
        $("#upload_photo").uploadify({
            'formData': {
                'target' : 'avatar',    //上传至public/uploads目录下的子目录
                '_token'     : "{{csrf_token()}}"
            },
            'buttonClass'        :    'upload',
            'fileSizeLimit'        :    '2MB',
            'fileTypeDesc'        :     '选择图片',
            'fileTypeExts'         :     '*.jpg;*.png',
            'height'            :    '30',
            'width'                :    '100',
            'method'            :    'post',
            'multi'                :     false,
            'swf'                :    '/plugins/uploadify_3.2.1/uploadify.swf',
            'uploader'            :    "{{route('upload.images')}}",
            'uploadLimit'        :  1,
            'buttonText'        :    '上传头像',
            'onUploadSuccess'    :    function(file, data){
                $('#user_avatar').html('<img src="'+ data +'" />');
                $("input[name='avatar_url']").val(data);
            },
            'overrideEvents' : [ 'onUploadProgress', 'onUploadComplete', 'onSelect', 'onDialogClose', 'onUploadSuccess', 'onUploadError', 'onSelectError' ],
            'onSelectError' : uploadify_onSelectError
        });
    </script>
    <script>
        $('#company_add').click(function(){
            var company = $("input[name='company']").val();
            $.ajax({
                type : "POST",
                url : '{{route('member.info.company')}}',
                dataType : 'json',
                data:{"company" : company,  '_token' : "{{csrf_token()}}"},
                success : function(data) {
                    console.log(data)
                    if (data.code == 0) {
                        toastr.success(data.message,'');
                        $('.company').html(company)
                    } else {
                        toastr.error(data.message,'');
                        $('.company').html(company);
                        window.location.href="{{ route('member.company.index') }}"
                    }
                }
            })
        })
    </script>

@endsection