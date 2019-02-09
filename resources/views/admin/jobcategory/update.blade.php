@extends('admin.layouts.base')

@section('title','职业分类创建')

@section('pageHeader','职业分类创建')

@section('pageDesc','DashBoard')

@section('content')
    <div class="row">
        <div class="col-md-8 ">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">编辑职业分类</h3>
                </div>
                <div class="panel-body">
                    @include('admin.partials.errors')
                    @include('admin.partials.success')
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.job.category.save') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="{{ $category->id }}">
                        <div class="form-group">
                            <label for="tag" class="col-md-3 control-label">职业分类名称</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="title" value="{{$category->title}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pid" class="col-md-3 control-label">所属分类</label>
                            <div class="col-md-6">
                                <select class="form-control" name="parent_id">
                                    <option value="0">顶级分类</option>
                                    @foreach($categories as $cate)
                                        <option value="{{$cate->id}}" @if($category->parent_id == $cate->id) selected @endif>
                                            @for($i=0;$i<$cate->depth;$i++)
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                            @endfor
                                            {{$cate->title}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status" class="col-md-3 control-label">是否显示</label>
                            <div class="col-md-6">
                                <input type="radio"  name="status" value="1" checked>是
                                <input type="radio"  name="status"  value="0">否
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sort" class="col-md-3 control-label">排序</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="sort" value="0">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-3">
                                <button type="submit" class="btn btn-primary btn-md">
                                    <i class="fa fa-plus-circle"></i>添加
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
