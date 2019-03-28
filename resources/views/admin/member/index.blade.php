@extends('admin.layouts.base')

@section('title', $title)
@section('css')
    <link href="/plugins/bootstrap-switch/css/bootstrap-switch.css" rel="stylesheet">
@endsection
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
                            <th>ID</th>
                            <th>真实姓名</th>
                            <th>昵称</th>
                            <th>手机号</th>
                            <th>邮箱</th>
                            <th>积分</th>
                            <th>等级</th>
                            <th>头像</th>
                            <th>状态</th>
                            <th>创建日期</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($users->count())
                            @foreach($users as $v)
                                <tr>
                                    <td>{{$v->id}}</td>
                                    <td>{{$v->name}}</td>
                                    <td>{{$v->nickname}}</td>
                                    <td>{{$v->mobile}}</td>
                                    <td>{{$v->email}}</td>
                                    <td>{{$v->integral}}</td>
                                    <td>{{$v->level}}</td>
                                    <td><img  src="{{asset('storage/'.$v->avatar)}}" class="img-rounded" style="max-width: 100px;max-height: 100px;"></td>
                                    <td>
                                        <div class="switch">
                                            <input class="origin" type="checkbox" data-id="{{ $v->id }}" name="my-checkbox" @if($v->status) checked @endif>
                                        </div>
                                    </td>
                                    <td>{{$v->created_at}}</td>
                                    <td>
                                        <a style="margin:3px;"  href="{{route('admin.member.show', ['id' => $v->id])}}" class="X-Small btn-xs text-success"><i class="fa fa-edit"></i>编辑</a>
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
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>

@stop
@section('js')
    <script type="text/javascript" src="/plugins/bootstrap-switch/js/bootstrap-switch.js"></script>
    <script>
        //初始化开关及状态修改
        $("[name='my-checkbox']").bootstrapSwitch({
            size: "mini",
            onText: "正常",
            offText: "禁用",
            onSwitchChange:function(el, data){
                var _this = $(this);
                var id = _this.attr('data-id');
                $.ajax({
                    type:'GET',
                    url:'{{ route('admin.member.changestatus') }}',
                    dataType:'json',
                    data:{id:id},
                    success:function(dataS){
                        //还原按钮
                        if (dataS.status == 1){
                            toastr.success(dataS.message,'');
                        }else{
                            toastr.error(dataS.message,'');
                            _this.bootstrapSwitch('toggleState', true);
                        }
                    },
                    error:function(xhr){
                        _this.bootstrapSwitch('toggleState', true);
                        toastr.error(data.message,'');
                    }
                })
            }
        });
    </script>
@endsection
