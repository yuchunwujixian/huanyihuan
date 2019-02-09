@extends('admin.layouts.base')

@section('title','游戏管理')

@section('pageHeader','游戏列表')

@section('pageDesc','DashBoard')

@section('content')

    <div class="row page-title-row" id="dangqian" style="margin:5px;">
        <div class="col-md-6">
            <span style="margin:3px;" id="cid" attr="" class="btn-flat text-info"> 游戏列表</span>
        </div>
    </div>


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
                            <th class="hidden-sm">图标</th>
                            <th class="hidden-sm">运营公司</th>
                            <th class="hidden-sm">研发公司</th>
                            <th class="hidden-sm">类型</th>
                            <th class="hidden-sm">创建时间</th>
                            <th data-sortable="false">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $v)
                            <tr>
                                <td>{{$v['id']}}</td>
                                <td>{{$v['title']}}</td>
                                <td>{{$v['icon']}}</td>
                                <td>{{$v->companyInfo->title}}</td>
                                <td>{{$v['company']}}</td>
                                <td>{{$jobc['type'][$v['type_id']]}}</td>
                                <td>{{$v['created_at']}}</td>
                                <td>
                                    <a style="margin:3px;"  href="{{ route('admin.game.edit', ['id' => $v['id']]) }}" class="X-Small btn-xs text-success "><i class="fa fa-edit"></i>查看</a>
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

