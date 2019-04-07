@extends('public.base')

@section('title', $title)

@section('uc_here', $uc_here)

@section('css')
    <link rel="stylesheet" href="/dist/css/personal/personal.css">
    <link rel="stylesheet" href="/dist/css/personal/basicinfo.css">
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
                <ul class="list-group text-center">
                    <li class="list-group-item thumbnail">
                        <img class="img-thumbnail" src="{{ asset('storage/'.Auth::guard()->user()->avatar) }}" onerror="this.src='/img/default_avatar.png';this.onerror=null;">
                    </li>
                    <li class="list-group-item active disabled">免费域名注册</li>
                    <li class="list-group-item">免费 Window 空间托管</li>
                    <li class="list-group-item">图像的数量</li>
                    <li class="list-group-item">24*7 支持</li>
                    <li class="list-group-item">每年更新成本</li>
                </ul>
            </div>
        </div>
    <!-- 内容部分 -->
        <div class="wrapper">
            <div class="right-content">
                <form action="{{route('member.info.store')}}" id="signupForm" method="post" class="user-info-input">
                    {{csrf_field()}}
                    <input type="hidden" value="{{$userInfo->id}}" name="id">
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
                                <input class="user-phone" readonly type="text" value="{{$userInfo->email}}" />
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="left-form">所在公司</div>
                            <div class="right-form company">
                                @if($userInfo->companyInfo)
                                    {{$userInfo->companyInfo->title}}
                                @else
                                    <input name="company" type="text" placeholder="例如：北京炯米互联有限公司" style="width: 400px;display: inline-block"/>
                                    <div style="width: 50px;text-align: center;display: inline-block;cursor: pointer" id="company_add">添加</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="left-form">姓名</div>
                            <div class="right-form">
                                <input id="user_name" name="name" type="text" placeholder="例如：王震" value="{{$userInfo->name}}"/>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="left-form">部门</div>
                            <div class="right-form">
                                <input id="user_department" name="department" type="text" placeholder="例如：策划部" value="{{$userInfo->department}}"/>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="left-form">职务</div>
                            <div class="right-form">
                                <input id="user_duties" name="position" type="text" placeholder="例如：文案策划" value="{{$userInfo->position}}"/>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="left-form">负责区域</div>
                            <div class="right-form">
                                <input id="user_eare" name="manage_area" type="text" placeholder="例如：华东" value="{{$userInfo->manage_area}}"/>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="left-form">负责事宜</div>
                            <div class="right-form">
                                <textarea id="user_thing" name="manage_matters" type="text" placeholder="说明一下自己的职责">{{$userInfo->manage_matters}}</textarea>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="left-form">手机号</div>
                            <div class="right-form">
                                <input type="text" name="mobile" value="{{$userInfo->mobile}}" placeholder="请输入你的手机号" />
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="left-form">个人说明</div>
                            <div class="right-form">
                                <textarea name="description" placeholder="你的自我说明">{{$userInfo->description}}</textarea>
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="save-btn" value="保存" />
                </form>
            </div>
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