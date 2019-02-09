@extends('admin.layouts.base')

@section('title','职位管理')

@section('pageHeader','职位列表')

@section('pageDesc','DashBoard')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                @include('admin.partials.errors')
                @include('admin.partials.success')
                <div class="box-body">
                    <table id="tags-table" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th class="hidden-sm">ID</th>
                            <th class="hidden-sm">名称</th>
                            <th class="hidden-sm">发布者</th>
                            <th class="hidden-sm">公司名</th>
                            <th class="hidden-sm">分类</th>
                            <th class="hidden-sm">薪水范围</th>
                            <th class="hidden-sm">工作经验</th>
                            <th class="hidden-sm">学历</th>
                            <th class="hidden-sm">性质</th>
                            <th class="hidden-md">创建日期</th>
                            <th data-sortable="false">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $v)
                            <tr>
                                <td>{{$v['id']}}</td>
                                <td>{{$v['title']}}</td>
                                <td>{{$v->userInfo->name}}</td>
                                <td>{{$v->companyInfo->title}}</td>
                                <td>{{$v->categoryInfo->title}}</td>
                                <td>{{$v['salary_start']}} - {{$v['salary_end']}}</td>
                                <td>{{$jobc['experience'][$v['experience']]}}</td>
                                <td>{{$jobc['education'][$v['education']]}}</td>
                                <td>{{$jobc['type'][$v['type']]}}</td>
                                <td>{{$v['created_at']}}</td>
                                <td>
                                    <a style="margin:3px;"  href="{{ route('admin.job.update', ['id' => $v['id']]) }}" class="X-Small btn-xs text-success "><i class="fa fa-edit"></i>查看</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop

