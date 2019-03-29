@extends('admin.layouts.base')

@section('title', $title)
@section('css')
    <link href="/plugins/bootstrap-switch/css/bootstrap-switch.css" rel="stylesheet">
    <style>
        .enable-sort .glyphicon.glyphicon-sort{
            color: #f0f0f0;
        }
        .enable-sort .glyphicon{
            color: blue;;
        }
        .enable-sort{
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-body">
                    <form class="form-inline">
                        &nbsp;&nbsp;
                        <div class="form-group">
                            <select class="selectpicker form-control"  name="type">
                                <option value="0">--请选择--</option>
                                <option value="name" @if(app('request')->get('type') == 'name') selected @endif>真实姓名</option>
                                <option value="nickname" @if(app('request')->get('type') == 'nickname') selected @endif>昵称</option>
                                <option value="mobile" @if(app('request')->get('type') == 'mobile') selected @endif>手机号</option>
                                <option value="email" @if(app('request')->get('type') == 'email') selected @endif>邮箱</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>关键词</label>
                            <input type="text" class="form-control" name="keyword" value="{{ app('request')->get('keyword') }}" placeholder="关键词">
                            &nbsp;&nbsp;
                            <label>
                                <input type="checkbox" class="form-control" name="like" @if(app('request')->get('like')) checked @endif>模糊查询
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>搜索</button>
                        <a href="{{ route('admin.member.index') }}" class="btn btn-default"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>重置</a>
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
                            <th>真实姓名</th>
                            <th>昵称</th>
                            <th>手机号</th>
                            <th>邮箱</th>
                            @if($input['order'] == 'integral desc')
                            <th class="enable-sort" onclick="order('integral asc')">
                                积分<span class="glyphicon glyphicon-arrow-down"></span>
                            </th>
                            @elseif($input['order'] == 'integral asc')
                                <th class="enable-sort" onclick="order('integral desc')">
                                    积分<span class="glyphicon glyphicon-arrow-up"></span>
                                </th>
                            @else
                                <th class="enable-sort" onclick="order('integral desc')">
                                    积分<span class="glyphicon glyphicon-sort"></span>
                                </th>
                            @endif
                            @if($input['order'] == 'level desc')
                                <th class="enable-sort" onclick="order('level asc')">
                                    等级<span class="glyphicon glyphicon-arrow-down"></span>
                                </th>
                            @elseif($input['order'] == 'level asc')
                                <th class="enable-sort" onclick="order('level desc')">
                                    等级<span class="glyphicon glyphicon-arrow-up"></span>
                                </th>
                            @else
                                <th class="enable-sort" onclick="order('level desc')">
                                    等级<span class="glyphicon glyphicon-sort"></span>
                                </th>
                            @endif
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
                                        <a style="margin:3px;"  href="{{route('admin.member.edit', ['id' => $v->id])}}" class="X-Small btn-xs text-success"><i class="fa fa-edit"></i>编辑</a>
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
                    {{$users->appends($input)->links()}}
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

        //排序
        var url = "{!! route('admin.member.index', $input) !!}";
        function order(order){
            if (url.indexOf('?')>0){
                var reg = new RegExp("order=([^&]*)(&|$)", "i");
                url = url.replace(reg, "");
                window.location.href = url + "&order=" + order;
            }else{
                window.location.href = url + "?order=" + order;
            }
        }
    </script>
@endsection
