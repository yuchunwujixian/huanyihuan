@extends('public.base')

@section('title','用户中心-公司信息')

@section('uc_here', '公司信息')

@section('css')
    <link rel="stylesheet" href="/dist/css/personal/personal.css">
    <link rel="stylesheet" href="/dist/css/personal/companyinfo.css">
@endsection

@section('content')
    @include('public.member_header')

    <div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <div class="object" id="object_four"></div>
                <div class="object" id="object_three"></div>
                <div class="object" id="object_two"></div>
                <div class="object" id="object_one"></div>
            </div>
        </div>
    </div>

    <!-- 内容部分 -->
    <div class="wrapper">
        @include('public.member_left')
        <div class="right-content">
            @if($data)
            <form action="{{Route('member.company.store')}}" method="post" id="signupForm" class="user-info-input">
                {{csrf_field()}}
                <input type="hidden" value="{{$data->id}}" name="id">
                <div class="input-content">
                    <div class="">
                        <div class="left-form">公司logo</div>
                        <div class="right-form">
                            <style>.right-form img {width: 120px;height: auto}</style>
                            <div id="company_logo_url" style="margin-bottom: 10px">
                                @if($data->logo)<img src="{{$data->logo}}">@endif
                            </div>
                            @if($data->status < 1)
                            <input id="upload_company_logo" class="upload_button" style="margin-top: 10px" type="button" value="本地上传"/>
                            <input type="hidden" name="company_logo_url">
                            @endif
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="left-form">公司</div>
                        <div class="right-form">
                            <input id="company_name" name="title"  {{$disabled_text}} type="text" value="{{$data->title}}" placeholder="请输入公司名称">
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="left-form">官网</div>
                        <div class="right-form">
                            <input id="company_url" name="company_url" type="url" {{$disabled_text}} value="{{$data->url}}" placeholder="请输入公司官网">
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="left-form">联系人</div>
                        <div class="right-form">
                            <input id="contact" name="contact" type="text" {{$disabled_text}} value="{{$data->contact}}" placeholder="请输入公司联系人">
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="left-form">联系电话</div>
                        <div class="right-form">
                            <input id="telephone" name="telephone" type="text" {{$disabled_text}} value="{{$data->telephone}}" placeholder="请输入公司联系电话">
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="left-form">邮箱</div>
                        <div class="right-form">
                            <input id="company_email" name="company_email" {{$disabled_text}} value="{{$data->resume_receive_email}}" type="text" placeholder="请输入公司邮箱">
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="left-form">所在省市</div>
                        <div class="right-form">
                            <div style="float: left">
                                @if($data->status)
                                    {{$data->province_name}}
                                @else
                                <select name="province_name" id="province" style="height: 25px;">
                                    <option value="">请选择</option>
                                    @foreach($provinces as $province)
                                        <option value="{{$province->name}}|{{$province->code}}" data-index="{{$province->code}}" @if($data->province_name == $province->name) selected @endif>{{$province->name}}</option>
                                    @endforeach
                                </select>
                                @endif
                            </div>
                            <div style="float: left;margin-left: 10px;">
                                @if($data->status)
                                    {{$data->city_name}}
                                @else
                                    <select name="city_name" id="city" style="height: 25px;">
                                        <option value="{{$data->city_name}}" id="cityOption">{{$data->city_name}}</option>
                                    </select>
                                @endif
                            </div>
                            <div style="float: left;margin-left: 10px;">
                                @if($data->status)
                                    {{$data->area_name}}
                                @else
                                <select name="area_name" id="area" style="height: 25px;">
                                    <option value="{{$data->area_name}}" id="cityOption">{{$data->area_name}}</option>
                                </select>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="left-form">详细地址</div>
                        <div class="right-form">
                            <input id="company_address" name="company_address" type="text" {{$disabled_text}} value="{{$data->address}}" placeholder="详细地址，街道小区写字楼">
                        </div>
                    </div>
                    <div class="company-type">
                        <div class="left-form">类型</div>
                        <div class="right-form">
                            @foreach($job_config['company_type'] as $k => $v)
                            <span>
                                <input type="checkbox" id="research"  {{$disabled_text}} name="company_type[]" value="{{$k}}" @if(in_array($k, $company_type)) checked @endif>
                                <label for="research">{{$v}}</label>
                            </span>
                            @endforeach
                        </div>
                    </div>
                    <div class="company-title" style="padding-left: 0px">公司简介</div>
                    <textarea name="description" rows="15" cols="80" {{$disabled_text}} >{{$data->description}}</textarea>
                    @if($data->status == 0)
                        <div class="form-item" style="margin-top: 20px">
                            <span style="color: red">您的企业信息需等待审核</span>
                        </div>
                    @elseif ($data->status == 2)
                        <div class="form-item" style="margin-top: 20px">
                            @if(!empty($apply_modify_info))
                                <span style="color:red">您的公司信息被驳回，您已提交申请，请耐心等待。</span>
                            @else
                                <span><a href="{{route('member.company.apply.modify.info')}}" style="color: red">您的公司信息被驳回，若需修改请点击《提交申请》</a></span>
                            @endif
                        </div>
                        <div class="form-item">
                            <div class="left-form">驳回理由</div>
                            <div class="right-form">{{ $data->reason }}</div>
                        </div>
                    @else
                        <div class="form-item" style="margin-top: 20px">
                            @if(!empty($apply_modify_info))
                                <span style="color:red">您的公司信息已通过审核，您已提交修改申请，请耐心等待。</span>
                            @else
                                <span><a href="{{route('member.company.apply.modify.info')}}" style="color: green">您的公司信息已通过审核，若需修改请点击《提交申请》</a></span>
                            @endif
                        </div>
                    @endif
                </div>
            </form>
            <form method="post" action="{{route('member.company.store_company_pserson')}}">
                {{csrf_field()}}
                <div class="input-content">
                    <div class="company-title">联系人</div>
                    <div class="contact-content" style="height: 100%">
                        <div class="contact-title">
                            <span>
                                姓名
                            </span><span>
                                职务
                            </span><span>
                                负责区域
                            </span><span>
                                负责事宜
                            </span><span>
                                联系方式
                            </span>
                        </div>
                        @foreach($persons as $person)
                        <div class="contact-info">
                            <span>
                                {{$person->name}}
                            </span><span>
                                {{$person->manage_position}}
                            </span><span>
                                {{$person->manage_area}}
                            </span><span>
                                {{$person->manage_matters}}
                            </span><span>
                                {{$person->telephone}}
                            </span>
                        </div>
                        @endforeach
                    </div>

                    <div style="margin-top: 40px">
                        <div class="form-item">
                            <div class="left-form">姓名</div>
                            <div class="right-form">
                                <input id="name" name="name" type="text" placeholder="请输入联系人姓名">
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="left-form">职务</div>
                            <div class="right-form">
                                <input id="manage_position" name="manage_position" type="text" placeholder="请输入职务">
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="left-form">负责区域</div>
                            <div class="right-form">
                                <input id="manage_area" name="manage_area" type="text" placeholder="请输入负责区域">
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="left-form">负责事宜</div>
                            <div class="right-form">
                                <input id="manage_matters" name="manage_matters" type="text" placeholder="请输入负责事宜">
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="left-form">联系方式</div>
                            <div class="right-form">
                                <input id="telephone" name="telephone" type="text" placeholder="请输入联系方式">
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="save-btn" style="margin-bottom: 10px;" value="保存" />
                </div>
            </form>
            <div style="margin: 30px; ">
                <form method="post" action="{{route('member.company.store_company_environment')}}">
                    {{csrf_field()}}
                    <input type="hidden" name="company_id" value="{{$data->id}}">
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    <div class="form-item">
                        <div class="left-form">公司环境</div>
                        <div class="right-form">
                            <input id="upload_photo" class="upload_button" type="button" value="本地上传"/>
                            <input type="hidden" name="company_environment_url">
                        </div>
                    </div>
                    <style>
                        .company_photos{width: 108px;height: 150px; display: inline-block; margin-left: 8px;line-height: 150px;}
                        .company_photos img {width: 100%; vertical-align: middle}
                    </style>
                    <!--是否上传图片-->
                    @if($photos->count())
                        <div id="company_photos_lists" style="margin-top: 30px;">
                            @foreach($photos as $photo)
                                <div class="company_photos" style="position: relative;border: 1px solid #ddd">
                                    <span class="del"  style="position: absolute;top: -68px;right: 0;font-size: 14px;color: red;cursor: pointer" data-index="{{ $photo->id }}">X</span>
                                    <img src="{{$photo->url}}" />
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div id="company_photos_lists" style="margin-top: 30px;height: 135px"></div>
                    @endif
                    <input type="submit" class="save-btn" style="margin-bottom: 10px;" value="保存" />
                </form>
            </div>
            @else
                <form action="{{Route('member.company.store')}}" method="post" id="signupForm" class="user-info-input">
                    {{csrf_field()}}
                    <div class="input-content" style="border-bottom:none">
                        <div class="">
                            <style>
                                #company_logo_url{width: 120px; display: inline-block; margin-left: 96px;}
                                #company_logo_url img {width: 100%;}
                            </style>
                            <div class="left-form">公司logo</div>
                            <div class="right-form">
                                <input id="upload_company_logo" class="upload_button" style="margin-top: 10px" type="button" value="本地上传"/>
                                <input type="hidden" name="company_logo_url">
                            </div>
                            <div id="company_logo_url" style="margin-bottom: 10px">
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="left-form">公司</div>
                            <div class="right-form">
                                <input id="company_name" name="title"  type="text" placeholder="请输入公司名称">
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="left-form">官网</div>
                            <div class="right-form">
                                <input id="company_url" name="company_url" type="url" value="http://" placeholder="请输入公司官网">
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="left-form">联系人</div>
                            <div class="right-form">
                                <input id="contact" name="contact" type="text" placeholder="请输入公司联系人"  value="{{ Auth::user()->name }}">
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="left-form">联系电话</div>
                            <div class="right-form">
                                <input id="telephone" name="telephone" type="text" placeholder="请输入公司联系电话"  value="{{ Auth::user()->mobile }}">
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="left-form">邮箱</div>
                            <div class="right-form">
                                <input id="company_email" name="company_email" type="text" placeholder="请输入公司邮箱"  value="{{ Auth::user()->email }}">
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="left-form">所在省市</div>
                            <div class="right-form">
                                <div style="float: left">
                                    <select name="province_name" id="province" style="height: 25px;">
                                        <option value="">请选择</option>
                                        @foreach($provinces as $province)
                                            <option value="{{$province->name}}|{{$province->code}}" data-index="{{$province->code}}">{{$province->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div style="float: left;margin-left: 10px;">
                                    <select name="city_name" id="city" style="height: 25px;">
                                        <option value="" id="cityOption">请选择</option>
                                    </select>
                                </div>
                                <div style="float: left;margin-left: 10px;">
                                    <select name="area_name" id="area" style="height: 25px;">
                                        <option value="" id="areaOption">请选择</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="left-form">详细地址</div>
                            <div class="right-form">
                                <input id="company_address" name="company_address" type="text" placeholder="详细地址，街道小区写字楼">
                            </div>
                        </div>
                        <div class="company-type">
                            <div class="left-form">类型</div>
                            <div class="right-form">
                                @foreach($job_config['company_type'] as $k => $v)
                                    <span>
                                <input type="checkbox" id="research" name="company_type[]" value="{{$k}}">
                                <label for="research">{{$v}}</label>
                            </span>
                                @endforeach
                            </div>
                        </div>
                        <div class="company-title" style="padding-left: 0px">公司简介</div>
                        <textarea name="description" rows="15" cols="80"></textarea>
                        <input type="submit" class="save-btn" style="margin-bottom: 10px;" value="保存" />
                    </div>
                </form>
            @endif

        </div>
    </div>
@endsection

@section('js')
    <script src="/dist/js/personal/company.js"></script>
    <script src="{{asset('/dist/js/zone.js')}}"></script>
    <script>zone.address();</script>
    <script>
        loadShow = function(){
            $("#loading").show();
        };
        loadFadeOut=function(){
            $("#loading").fadeOut(500);
        };
    </script>
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
        $("#upload_company_logo").uploadify({
            'formData': {
                'target' : 'company_logo',    //上传至public/uploads目录下的子目录
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
            'buttonText'        :    '上传公司logo',
                    'onUploadSuccess'    :    function(file, data){
                $('#company_logo_url').html('<img src="'+ data +'" />');
                $("input[name='company_logo_url']").val(data);
            },
            'overrideEvents' : [ 'onUploadProgress', 'onUploadComplete', 'onSelect', 'onDialogClose', 'onUploadSuccess', 'onUploadError', 'onSelectError' ],
            'onSelectError' : uploadify_onSelectError
        });
        $("#upload_photo").uploadify({
            'formData': {
                'target' : 'company_environment',    //上传至public/uploads目录下的子目录
                '_token'     : "{{csrf_token()}}"
            },
            'buttonClass'        :    'upload',
            'fileSizeLimit'        :    '2MB',
            'fileTypeDesc'        :     '选择图片',
            'fileTypeExts'         :     '*.jpg;*.png',
            'height'            :    '30',
            'width'                :    '100',
            'method'            :    'post',
            'multi'                :     true,
            'swf'                :    '/plugins/uploadify_3.2.1/uploadify.swf',
            'uploader'            :    "{{route('upload.images')}}",
            'uploadLimit'        :  5,
            'buttonText'        :    '上传公司照片',
            'onUploadSuccess'    :    function(file, data){
                var comapny_e_url = $("input[name='company_environment_url']");
                if(comapny_e_url.val().length > 0) {
                    var c =  comapny_e_url.val() + ',' + data;
                } else {
                    var c = data;
                }
                comapny_e_url.val(c);
                $('#company_photos_lists').append('<div class="company_photos" style="position: relative;border: 1px solid #ddd">' +
//                        '<span class="del" style="position: absolute;top: -68px;right: 0;font-size: 14px;color: red" data-index="0">X</span>' +
                        '<img src="'+ data +'" />' +
                        '</div>');
            },
            'overrideEvents' : [ 'onUploadProgress', 'onUploadComplete', 'onSelect', 'onDialogClose', 'onUploadSuccess', 'onUploadError', 'onSelectError' ],
            'onSelectError' : uploadify_onSelectError
        });
        $('.del').click(function(){
            var id = $(this).data('index');
            $.ajax({
                url:"{{ route('member.company.destroy_company_environment') }}",
                type:"POST",
                dataType : 'json',
                data:{"id" : id, '_token' : "{{csrf_token()}}"},
                success : function(data) {
                    if (data.code == 0) {
                        toastr.success(data.message,'');
                        location.reload();
                    } else {
                        toastr.error(data.message,'');
                    }
                }
            })

        })
    </script>
@endsection