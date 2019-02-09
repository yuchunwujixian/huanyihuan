@extends('public.base')

@section('title','用户中心-职位列表')

@section('uc_here', '职位列表')

@section('css')
    <link rel="stylesheet" href="/dist/css/personal/personal.css">
    <link rel="stylesheet" href="/dist/css/personal/recruitment.css">
@endsection

@section('js')
    <script src="/dist/js/personal/recruitment.js"></script>
@endsection

@section('uc_here', '人才招聘')

@section('content')
    @include('public.member_header')
    <!-- 内容部分 -->
    <div class="wrapper">
        @include('public.member_left')
        <div class="right-content">
            <div class="right-wrapper">
                @if($is_register_company_info)
                    <div class="go-release-btn">
                        @if($company_info->status)
                        <a href="{{route('member.job.create')}}">
                            <span>发布招聘</span>
                            <span class="icon iconfont icon-jia"></span>
                        </a>
                            @else
                            <font color="red">您的企业信息未通过审核，请在审核通过后发布招聘信息</font>
                        @endif
                    </div>
                    <div id="cruitment-content">
                        @foreach($jobs as $job)
                        <div class="one-item">
                            <div class="one-item-title">
                                {{$job->title}}
                                <span>{{$job_config['status'][$job['status']]}}</span>
                            </div>
                            <div class="one-item-content">
                                <p>
                                    {{$province_config[$job->province_code]}} |
                                    {{$job_config['education'][$job['education']]}} |
                                    {{$job_config['experience'][$job['experience']]}} |
                                    {{$job->salary_start}}-{{$job->salary_end}}元
                                </p>
                                <p>{{$job->updated_at}}</p>
                                <div class="operation">
                                    <a class="inline-block" href="{{ route('member.job.update', ['id' => $job->id]) }}">
                                        <i class="icon iconfont icon-edit"></i>
                                        编辑职位
                                    </a>
                                    <a class="inline-block" href="{{ route('member.job.destroy', ['id' => $job->id]) }}">
                                        <i class="icon iconfont icon-shanchu"></i>
                                        删除职位
                                    </a>
                                </div>

                            </div>
                        </div>
                        @endforeach
                    </div>
                    <style>
                        .page {margin-top: 30px}
                        .page ul li {float: left; width: 25px}
                    </style>
                    <div class="page">
                        {{ $jobs->links() }}
                    </div>
                    @else
                    <p>您还为注册企业信息，<a href="{{route('member.company.index')}}">前往注册</a> </p>
                @endif
            </div>
        </div>
    </div>
@endsection