@extends('admin.layouts.base')
@section('title', $title)
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-body">
                    <form class="form-inline">
                        &nbsp;&nbsp;
                        <div class="form-group">
                            <select class="selectpicker form-control" title="发送方式"  name="sms_type">
                                <option value="1" @if(app('request')->get('sms_type') == 1) selected @endif>手机号</option>
                                <option value="2" @if(app('request')->get('sms_type') == 2) selected @endif>邮箱</option>
                            </select>
                        </div>
                        &nbsp;&nbsp;
                        <div class="form-group">
                            <select class="selectpicker form-control" title="发送类型"  name="type">
                                <option value="1" @if(app('request')->get('type') == 1) selected @endif>注册</option>
                                <option value="2" @if(app('request')->get('type') == 2) selected @endif>重置密码</option>
                            </select>
                        </div>
                        &nbsp;&nbsp;
                        <div class="form-group">
                            <select class="selectpicker form-control" title="发送状态"  name="status">
                                <option value="0" @if(app('request')->get('status') === 0 || app('request')->get('status') === '0') selected @endif>失败</option>
                                <option value="1" @if(app('request')->get('status') == 1) selected @endif>成功</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>搜索</button>
                        <a href="{{ route('admin.sms.index') }}" class="btn btn-default"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>重置</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-body">
                    <table id="tags-table" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>UID</th>
                            <th>账号</th>
                            <th>发送方式</th>
                            <th>发送类型</th>
                            <th>发送码</th>
                            <th>发送状态</th>
                            <th>发送时间</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($sms->count())
                            @foreach($sms as $v)
                                <tr>
                                    <td>{{$v->id}}</td>
                                    <td>{{$v->user_id}}</td>
                                    <td>{{$v->username}}</td>
                                    <td>{{$v->sms_type==1?'手机号':'邮箱'}}</td>
                                    <td>{{$v->type?'注册':'重置密码'}}</td>
                                    <td>{{$v->code}}</td>
                                    <td>
                                        @if($v->status == 1)
                                            <span class="btn btn-default btn-success">成功</span>
                                        @else
                                            <span class="btn btn-default btn-danger">失败</span>
                                        @endif
                                    </td>
                                    <td>{{$v->created_at}}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-center">暂无数据</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    {{$sms->appends($input)->links()}}
                </div>
            </div>
        </div>
    </div>

@stop
