@extends('admin.layouts.base')

@section('title', $title)

@section('content')
    <div class="row">
        <div class="col-md-8 ">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $title }}</h3>
                </div>
                <div class="panel-body">
                    @include('admin.partials.errors')
                    @include('admin.partials.success')
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.category.save') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="tag" class="col-md-3 control-label">商品分类名称</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="title">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">父级分类</label>
                            <div class="col-md-6">
                                <select class="form-control" name="parent_id">
                                    <option value="0">顶级分类</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">
                                            @for($i=0;$i<$category->depth;$i++)
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                            @endfor
                                            {{$category->title}}
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
