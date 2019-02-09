@extends('admin.layouts.base')

@section('title','发布需求榜')

@section('pageHeader','发布需求榜')

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
                            <th class="hidden-sm">发布公司</th>
                            <th class="hidden-sm">联系人</th>
                            <th class="hidden-sm">区分</th>
                            <th class="hidden-sm">平台</th>
                            <th class="hidden-sm">合作方式</th>
                            <th class="hidden-sm">代理区域</th>
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
                                    <td>{{$v->companyInfo->title}}</td>
                                    <td>{{$v->contact}}</td>
                                    <td>{{$product_config['type'][$v['type_id']]}}</td>
                                    <td>
                                        @foreach($v->platformInfo($v->platform_id) as $k)
                                            {{$product_config['platform'][$k]}} |
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach(explode(',', $v['cooperation_id']) as $key => $value)
                                            {{$product_config['cooperation'][$value]}}/
                                        @endforeach
                                    </td>
                                    <td>{{$product_config['area'][$v['area_id']]}}</td>
                                    <td>
                                        @if($v->status == 1)
                                            <button type="button" class="btn btn-success btn-xs">
                                                正常
                                            </button>
                                        @elseif($v->status == 0)
                                            <button type="button" class="btn btn-primary btn-xs">
                                                待审核
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-danger btn-xs">
                                                已删
                                            </button>
                                        @endif
                                    </td>
                                    <td>{{$v->created_at}}</td>
                                    <td>
                                        <a href="{{route('admin.issue.demand.update', ['id' => $v->id])}}" class="X-Small btn-xs text-success"><i class="fa fa-edit"></i>查看</a>
                                        <a style="margin:3px;"  href="javascript:;" class="X-Small btn-xs text-success del"><i class="fa fa-times-circle"></i>删除</a>
                                        <input type="hidden" value="{{ $v->id }}">
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="11" style="text-align: center">暂无数据</td>
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
                    url:"{{ route('admin.issue.demand.destroy') }}",
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
