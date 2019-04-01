@extends('admin.layouts.base')

@section('title', $title)

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-blue">用户详细信息</h3>
                    </div>
                    <div class="panel-body">
                        @include('admin.partials.errors')
                        @include('admin.partials.success')
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.member.store') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <div class="form-group">
                                <label class="col-md-3 text-right">真实姓名</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="name" value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 text-right">昵称</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="nickname" value="{{ $user->nickname }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 text-right">手机号</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="moible" value="{{ $user->mobile }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 text-right">邮箱</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="email" value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 text-right">密码</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="password" name="password" autocomplete="new-password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 text-right control-label">积分</label>
                                <div class="col-md-6">
                                    <p class="form-control-static">{{ $user->integral }}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 text-right">等级</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="level" value="{{ $user->level }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 text-right">头像</label>
                                <div class="col-md-6">
                                    <img src="{{ asset('storage/'.$user->avatar) }}" class="img-rounded" style="max-width: 100px;max-height: 100px;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 text-right control-label">创建日期</label>
                                <div class="col-md-6">
                                    <p class="form-control-static">{{ $user->created_at }}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 text-right">状态</label>
                                <div class="col-md-6">
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="0" @if($user->status == 0)checked @endif> 禁用
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="1" @if($user->status == 1)checked @endif> 正常
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary">保存</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop