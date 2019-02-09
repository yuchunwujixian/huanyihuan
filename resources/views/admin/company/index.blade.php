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
                            <th class="hidden-sm">省</th>
                            <th class="hidden-sm">市</th>
                            <th class="hidden-sm">区</th>
                            <th class="hidden-sm">公司地址</th>
                            <th class="hidden-sm">网址</th>
                            <th class="hidden-sm">状态</th>
                            <th class="hidden-md">创建日期</th>
                            <th data-sortable="false">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $v)
                            <tr>
                                <td>{{$v->id}}</td>
                                <td>{{$v->title}}</td>
                                <td>{{$v->userInfo->name}}</td>
                                <td>{{$v->province_name}}</td>
                                <td>{{$v->city_name}}</td>
                                <td>{{$v->area_name}}</td>
                                <td>{{$v->address}}</td>
                                <td>{{$v->url}}</td>
                                <td>
                                    @if($v->status == 1)
                                        <button type="button" class="btn btn-primary btn-xs">正常
                                    @elseif($v->status == 2)
                                        <button type="button" class="btn btn-info btn-xs">不通过
                                    @else
                                        <button type="button" class="btn btn-danger btn-xs">待审核
                                    @endif
                                        </button>
                                </td>
                                <td>{{$v->created_at}}</td>
                                <td>
                                    <a style="margin:3px;"  href="{{route('admin.company.update', ['id' => $v->id])}}" class="X-Small btn-xs text-success"><i class="fa fa-edit"></i>查看</a>
                                    <a class="X-Small btn-xs text-success" href="{{route('admin.company.persons', array('id' => $v['id']))}}"><i class="fa fa-bars"></i>联系人</a>
                                    <a class="X-Small btn-xs text-success" href="{{route('admin.company.tianyancha', array('id' => $v['id']))}}"><i class="fa fa-bars"></i>天眼查</a>
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

