@extends('admin.layouts.base')

@section('title','反馈列表')

@section('pageHeader','反馈列表')

@section('pageDesc','DashBoard')

@section('content')

    <div class="row page-title-row" id="dangqian" style="margin:5px;">
        <div class="col-md-6">
            <span style="margin:3px;" id="cid" attr="" class="btn-flat text-info"> 反馈列表</span>
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
                            <th class="hidden-sm">留言</th>
                            <th class="hidden-md">创建日期</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $v)
                            <tr>
                                <td>{{$v->id}}</td>
                                <td>{{$v->content}}</td>
                                <td>{{$v->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop

