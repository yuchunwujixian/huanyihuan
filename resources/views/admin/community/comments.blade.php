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
                <p style="margin: 10px"><strong>查看评论</strong></p>
                <div class="box-body" style="margin-top: 10px">
                    <table id="tags-table" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th class="hidden-sm">ID</th>
                            <th class="hidden-sm">发布者</th>
                            <th class="hidden-sm">内容</th>
                            <th class="hidden-sm">匿名</th>
                            <th class="hidden-md">日期</th>
                            <th data-sortable="false">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if($comments->count())
                                @foreach($comments as $comment)
                                    <tr>
                                        <td>{{$comment->id}}</td>
                                        <td>{{$comment->userInfo->mobile}}（用户名：{{$comment->userInfo->name}}）</td>
                                        <td>{{str_limit($comment->content, 120)}}</td>
                                        <td>@if($comment->is_anonymity) 是 @else 否 @endif</td>
                                        <td>{{$comment->created_at}}</td>
                                        <td><a href="javascript:;" class="ajax_delete X-Small btn-xs text-success" data-index="{{$comment->id}}" data-index-2="{{$comment->post_id}}">删除</a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><td colspan="6">暂无数据</td></tr>
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
    $(".ajax_delete").click(function () {
        var comment_id = $(this).attr('data-index');
        var post_id = $(this).attr('data-index-2');
        $.get(
            "{{route('admin.community.comments.destroy')}}",
            {comment_id : comment_id, post_id : post_id, '_token' : "{{csrf_token()}}"},
            function (data) {
              if(data) {
                  toastr.success('成功删除');
              } else {
                  toastr.error('操作失败');
              }
              window.location.reload();
            }
        );
    });
  </script>
@endsection