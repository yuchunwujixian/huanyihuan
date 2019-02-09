@extends('admin.layouts.base')

@section('title','用户管理')

@section('pageHeader','用户列表')

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
                            <th class="hidden-sm">姓名</th>
                            <th class="hidden-sm">邮箱</th>
                            <th class="hidden-sm">手机号</th>
                            <th class="hidden-sm">公司</th>
                            <th class="hidden-sm">部门</th>
                            <th class="hidden-sm">负责区域</th>
                            <th class="hidden-sm">负责事宜</th>
                            <th class="hidden-sm">职务</th>
                            <th class="hidden-sm">积分</th>
                            <th class="hidden-sm">等级</th>
                            <th class="hidden-md">创建日期</th>
                            <th data-sortable="false">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($users->count())
                            @foreach($users as $v)
                                <tr>
                                    <td>{{$v->id}}</td>
                                    <td>{{$v->name}}</td>
                                    <td>
                                        @if($v->email)
                                            {{$v->email}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{$v->mobile}}</td>
                                    <td>
                                        @if($v->company_id)
                                            {{$v->companyInfo->title}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{$v->department}}</td>
                                    <td>{{$v->manage_area}}</td>
                                    <td>{{str_limit($v->manage_matters, 40)}}</td>
                                    <td>{{$v->position}}</td>
                                    <td>{{$v->integral}}</td>
                                    <td>{{$v->level}}</td>
                                    <td>{{$v->created_at}}</td>
                                    <td>
                                        <a style="margin:3px;"  href="{{route('admin.member.show', ['id' => $v->id])}}" class="X-Small btn-xs text-success"><i class="fa fa-edit"></i>详细信息</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="11">暂无数据</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>

@stop
@section('js')
    <link href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script>
    </script>
@endsection
