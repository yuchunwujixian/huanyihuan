@extends('admin.layouts.base')

@section('title', $title)

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-body">
                    <form class="form-inline">
                        <div class="form-group">
                            <label>商品状态</label>
                            <select class="selectpicker form-control"  name="status">
                                @foreach($goods_status as $key => $v)
                                    <option value="{{ $key }}" @if(app('request')->get('status') == $key) selected @endif>{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                        &nbsp;&nbsp;
                        <div class="form-group">
                            <label>商品名称</label>
                            <input type="text" class="form-control" name="search_title" value="{{ app('request')->get('search_title') }}" placeholder="商品名称，模糊查询">
                        </div>
                        &nbsp;&nbsp;
                        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>搜索</button>
                    </form>
                </div>
            </div>
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
                            <th>ID</th>
                            <th>商品名称</th>
                            <th>添加人</th>
                            <th>所属分类</th>
                            <th>商品数量</th>
                            <th>图片地址</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lists as $v)
                            <tr>
                                <td>{{$v->id}}</td>
                                <td>{{$v->title}}</td>
                                <td>{{$v->user->name}}</td>
                                <td>{{$v->category->title}}</td>
                                <td>{{$v->num}}</td>
                                <td><img  src="{{asset('storage/'.$v->img_url)}}" class="img-rounded" style="max-width: 100px;max-height: 100px;"></td>
                                <td>{{$goods_status[$v->status]}}</td>
                                <td>
                                    <a style="margin:3px;"  href="{{ route('admin.goods.update', ['id' => $v->id]) }}" class="X-Small btn-xs text-success "><i class="fa fa-edit"></i>修改</a>
                                </td>
                            </tr>
                         @endforeach
                        </tbody>
                    </table>
                    <div class="page text-right">
                        {{ $lists->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

