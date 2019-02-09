@extends('public.base')

@section('title','用户中心-发布需求')

@section('uc_here', '发布需求')

@section('css')
    <!-- 引入本组公共样式 -->
    <link rel="stylesheet" href="/dist/css/personal/personal.css">
    <!-- 引入本页独立样式 -->
    <link rel="stylesheet" href="/dist/css/personal/research.css">
    <link rel="stylesheet" href="/dist/css/personal/gameproduct.css">
@endsection

@section('content')
    @include('public.member_header')
    <!-- 内容部分 -->
    <div class="wrapper">
        @include('public.member_left')
        <div class="right-content">
            <form id="right-wrapper" action="{{ route('member.publishing.product.store') }}" method="post">
                {{csrf_field()}}
                @include('public.member_top')
                <div class="one-demand-content">
                    <div class="one-demand-name">
                        产品名称
                    </div>
                    <div class="one-demand relative">
                        <input type="text" class="inputlist" name="title" placeholder="例如：剑灵"/>
                    </div>
                </div>
                <div class="one-demand-content" style="height: auto">
                    <div class="one-demand-name">
                        上传logo
                    </div>
                    <div class="one-demand relative"  style="height: auto;line-height: normal">
                        <input id="upload_product_logo" class="upload_button" style="margin-top: 10px" type="button" value="本地上传"/>
                        <input type="hidden" name="logo">
                        <div id="prodcut_logo_url"></div>
                        <style>#prodcut_logo_url img {width: 120px;height: 120px}</style>
                    </div>
                </div>
                <div class="one-demand-content">
                    <div class="one-demand-name">
                        合作方式
                    </div>
                    <div class="one-demand relative">
                        @foreach($product_config['cooperation'] as $key => $value)
                        <input type="radio" name="cooperation_id" value="{{ $key }}">{{ $value }}
                        @endforeach
                    </div>
                </div>
                <div class="one-demand-content">
                    <div class="one-demand-name">
                        代理区域
                    </div>
                    <div class="one-demand relative">
                        @foreach($product_config['area'] as $key => $value)
                            <input type="radio" name="area_id" value="{{ $key }}">{{ $value }}
                        @endforeach
                    </div>
                </div>
                <div class="one-demand-content">
                    <div class="one-demand-name">
                        联系人
                    </div>
                    <div class="one-demand relative">
                        <input type="text" class="inputlist" name="contact" placeholder="请输入联系人">
                    </div>
                </div>
                <div class="one-demand-content">
                    <div class="one-demand-name">
                        联系方式
                    </div>
                    <div class="one-demand relative">
                        <select name="tel_type_id" style="display: inline-block;width: 14%;height: 30px;">
                            @foreach($product_config['tel_type'] as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                        <input style="display: inline-block;width: 85%;" type="text" class="inputlist" name="telephone" placeholder="请输入联系方式">
                    </div>
                </div>
                <div class="one-demand-content">
                    <div class="one-demand-name">
                        平台
                    </div>
                    <div class="one-demand relative">
                        @foreach($product_config['platform'] as $key => $value)
                            <input type="checkbox" name="platform_id[]" id="p{{$key}}" value="{{ $key }}" style="margin-left: 20px"><label for="p{{$key}}">{{ $value }}</label>
                        @endforeach
                    </div>
                </div>
                <div class="one-demand-content">
                    <div class="one-demand-name">
                        区分
                    </div>
                    <div class="one-demand relative">
                        @foreach($product_config['type'] as $key => $value)
                            <input type="radio" name="type_id" value="{{ $key }}">{{ $value }}
                        @endforeach
                    </div>
                </div>
                <div class="one-demand-content">
                    <div class="one-demand-name">
                        阶段
                    </div>
                    <div class="one-demand relative">
                        @foreach($product_config['period'] as $key => $value)
                            <input type="radio" name="period_id" value="{{ $key }}">{{ $value }}
                        @endforeach
                    </div>
                </div>
                <div class="one-demand-content">
                    <div class="one-demand-name">
                        游戏分类
                    </div>
                    <div class="one-demand relative">
                        <select name="game_type_id" style="width: 35%;height: 30px;">
                            @foreach($product_config['game_type'] as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="one-demand-content">
                    <div class="one-demand-name">
                        下载链接
                    </div>
                    <div class="one-demand relative">
                        <input type="text" name="url" onkeyup="this.value=this.value.toLowerCase()" value="http://" class="inputlist" placeholder="请输入产品下载链接">
                    </div>
                </div>
                <div class="one-demand-content"  style="height: auto">
                    <div class="one-demand-name">
                        产品介绍
                    </div>
                    <div class="one-demand relative"  style="height: auto">
                        <textarea class="introduction" name="description" placeholder="请输入产品介绍"  rows="12" cols="70" contenteditable="true"></textarea>
                    </div>
                </div>
                <div class="one-demand-content" style="height: auto">
                    <div class="one-demand-name">
                        需求及合作
                    </div>
                    <div class="one-demand relative" style="height: auto">
                        <textarea placeholder="请输入需求及合作" name="needs"  rows="12" cols="70"></textarea>
                    </div>
                </div>
                <div class="one-demand-content">
                    <div class="one-demand-name">
                        产品截图
                    </div>
                    <div class="one-demand relative">
                        <input id="upload_photo" class="upload_button" type="button" value="本地上传"/>
                        <input type="hidden" name="product_url">
                    </div>
                    <div style="float: left;margin-left: 200px;margin-top: -15px;">可最多上传5张，jpg/png类型图片</div>
                </div>
                <div id="prodcut_photos_lists" style="margin-top: 30px;height: 135px"></div>
                <style>.save{display: block;  margin: 30px auto 0;  width: 140px;  height: 45px;  border: 0;  background-color: #0064bc;  color: #fff;}
                    .product_photos img {width: 122px; height: 122px; float: left; margin-left: 10px;margin-bottom: 10px;}
                </style>
                <input type="submit" value="发布" id="releasebtn" style="margin: 30px auto;">
            </form>
        </div>
    </div>
    </div>
@endsection

@section('js')
    <script src="/dist/js/personal/research.js"></script>
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
        $("#upload_product_logo").uploadify({
            'formData': {
                'target' : 'product_logo',    //上传至public/uploads目录下的子目录
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
            'buttonText'        :    '上传产品logo',
            'onUploadSuccess'    :    function(file, data){
                $('#prodcut_logo_url').html('<img src="'+ data +'" />');
                $("input[name='logo']").val(data);
            },
            'overrideEvents' : [ 'onUploadProgress', 'onUploadComplete', 'onSelect', 'onDialogClose', 'onUploadSuccess', 'onUploadError', 'onSelectError' ],
            'onSelectError' : uploadify_onSelectError
        });
        $("#upload_photo").uploadify({
            'formData': {
                'target' : 'product',    //上传至public/uploads目录下的子目录
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
            'buttonText'        :    '上传产品截图',
            'onUploadSuccess'    :    function(file, data){
                var product_e_url = $("input[name='product_url']");
                if(product_e_url.val().length > 0) {
                    var c =  product_e_url.val() + ',' + data;
                } else {
                    var c = data;
                }
                product_e_url.val(c);
                $('#prodcut_photos_lists').append('<div class="product_photos"><img src="'+ data +'" /></div>');
            },
            'overrideEvents' : [ 'onUploadProgress', 'onUploadComplete', 'onSelect', 'onDialogClose', 'onUploadSuccess', 'onUploadError', 'onSelectError' ],
            'onSelectError' : uploadify_onSelectError
        });
    </script>
@endsection