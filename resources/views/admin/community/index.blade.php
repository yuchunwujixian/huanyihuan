@extends('admin.layouts.base')

@section('title','社区管理')

@section('pageHeader','社区列表')

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
                            <th class="hidden-sm">发布者</th>
                            <th class="hidden-sm">内容</th>
                            <th class="hidden-sm">点赞</th>
                            <th class="hidden-sm">收藏</th>
                            <th class="hidden-sm">评论</th>
                            <th class="hidden-sm">举报</th>
                            <th class="hidden-sm">实名</th>
                            <th class="hidden-sm">状态</th>
                            <th class="hidden-md">创建日期</th>
                            <th data-sortable="false">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($data->count())
                            @foreach($data as $v)
                                <tr>
                                    <td>{{$v->id}}</td>
                                    <td>{{$v->userInfo->name}}</td>
                                    <td>{{str_limit($v->content, 40)}}</td>
                                    <td>{{$v->points}}</td>
                                    <td>{{$v->collects}}</td>
                                    <td>{{$v->comments}}</td>
                                    <td>{{$v->postReports($v->id)}}</td>
                                    <td>
                                        @if($v->is_anonymity)
                                            <button type="button" class="btn btn-danger btn-xs">
                                                匿名
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-primary btn-xs">
                                                实名
                                            </button>
                                        @endif
                                    </td>
                                    <td>
                                        @if($v->status)
                                            <button type="button" class="btn btn-success btn-xs">
                                                正常
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-danger btn-xs">
                                                被禁
                                            </button>
                                        @endif
                                    </td>
                                    <td>{{$v->created_at}}</td>
                                    <td>
                                        <a href="{{route('admin.community.comments', ['id' => $v->id])}}" class="X-Small btn-xs text-success"><i class="fa fa-edit"></i>查看评论</a>
                                        <a style="margin:3px;"  href="{{route('admin.community.update', ['id' => $v->id])}}" class="X-Small btn-xs text-success"><i class="fa fa-edit"></i>详细信息</a>
                                        <a style="margin:3px;"  href="javascript:;" class="X-Small btn-xs text-success del"><i class="fa fa-times-circle"></i>删除</a>
                                        <input type="hidden" value="{{ $v->id }}">
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
                </div>
            </div>
        </div>
    </div>

@stop
@section('js')
    <link href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        $('.del').click(function(){
            if(confirm("确定要删除数据")){
                var id = $(this).next().val();
                $.ajax({
                    url:"{{ route('admin.community.destroy') }}",
                    type:"POST",
                    dataType : 'json',
                    data:{"id" : id, '_token' : "{{csrf_token()}}"},
                    success : function(data) {
                        if (data.code == 0) {
                            toastr.options = {"positionClass":"toast-top-center"};
                            toastr.success(data.message,'');
                            window.location.reload();
                        } else {
                            toastr.options = {"positionClass":"toast-top-center"};
                            toastr.error(data.message,'');
                        }
                    }
                })
            }
        })
    </script>
@endsection
