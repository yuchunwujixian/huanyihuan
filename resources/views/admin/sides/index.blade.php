@extends('admin.layouts.base')

@section('title', $title)

@section('content')

    <div class="row" style="margin-bottom: 5px">
        <div class="col-md-6">
            <a href="{{ route('admin.sides.create')}}" class="btn btn-success btn-md"><i class="fa fa-plus-circle"></i> 增加幻灯片 </a>
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
                            <th>幻灯片标题</th>
                            <th>跳转地址</th>
                            <th>图片地址</th>
                            <th>类型</th>
                            <th>排序</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lists as $v)
                            <tr>
                                <td>{{$v->id}}</td>
                                <td>{{$v->title}}</td>
                                <td>{{$v->url}}</td>
                                <td><img  src="{{$v->third_img_url}}" class="img-rounded" style="max-width: 100px;max-height: 100px;"></td>
                                <td>{{$sides_type[$v->type]}}</td>
                                <td>{{$v->sort}}</td>
                                <td>@if($v->status)正常@else否@endif</td>
                                <td>
                                    <a style="margin:3px;"  href="{{ route('admin.sides.update', ['id' => $v->id]) }}" class="X-Small btn-xs text-success "><i class="fa fa-edit"></i>查看</a>
                                    <a style="margin:3px;"  href="{{ route('admin.sides.del', ['id' => $v->id]) }}" class="X-Small btn-xs text-success "><i class="fa fa-times-circle"></i>删除</a>
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

