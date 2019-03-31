@extends('public.base')

@section('title', $title)
@section('css')
    <link rel="stylesheet" href="/dist/css/about.css">
@endsection

@section('content')
    <!-- 中部banner区域 -->
    <div class="banner b-shadow">
        @include('public.banner')
    </div>
    <div class="container">
        <div class="text-center margin-24">
            <h2 class="font-24">从此开启美好生活</h2>
            <p class="font-14 color-aaa margin-t-8">Start a good life from now on</p>
        </div>
    </div>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                <i class="glyphicon glyphicon-home"></i>&nbsp;&nbsp;
                <span>企业介绍</span>
            </div>
            <div class="panel-body max-w-img">
                @if(isset($base_config->description)){!! $base_config->description !!}@else 暂无数据@endif
            </div>
        </div>
    </div>
    <div class="container">
        <div class="panel panel-default about-about-us">
            <div class="panel-heading text-center">
                <i class="glyphicon glyphicon-phone-alt"></i>&nbsp;&nbsp;
                <span>联系我们</span>
            </div>
            <div class="panel-body">
                <div class="row same-height color-777">
                    <div class="col-xs-6 col-sm-4">
                        <ul class="list-unstyled">
                            <li>
                                <i class="glyphicon glyphicon-home"></i>
                                <span>江苏南京中航科技大厦</span>
                            </li>
                            <li>
                                <i class=""></i>
                                <span>ADD:Nanjing,Jiangsu,China</span>
                            </li>
                            <li>
                                <i class="glyphicon glyphicon-phone-alt"></i>
                                <span>18351424931</span>
                            </li>
                            <li>
                                <i class="glyphicon glyphicon-envelope"></i>
                                <span>342338015@qq.com</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                        <ul class="list-unstyled">
                            <li>Laravel中文网</li>
                            <li>Ghost中国</li>
                            <li>BootCDN</li>
                            <li>Packagist中国镜像</li>
                            <li>燃腾教育</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                <i class="glyphicon glyphicon-pencil"></i>&nbsp;&nbsp;
                <span>意见反馈</span>
            </div>
            <div class="panel-body">
                <form id="feedback-form" role="form" action="{{route('aboutus.feedback')}}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <textarea class="form-control" rows="3" name="content" placeholder="如果您能留下宝贵建议，我们将感激不尽！">{{ old('content') }}</textarea>
                    </div>
                    <div class="form-group">
                        <div class="fr">
                            <button type="submit" class="btn btn-default" id="submit">提交</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        $("#feedback-form").validate({
            errorClass: "text-danger",
            rules: {
                content: "required"
            },
            messages: {
                content: "请输入内容"
            }
        });
    </script>
@endsection

