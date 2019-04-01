@extends('admin.layouts.base')
@section('title', $title)
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-body">
                    <form class="form-inline">
                        <div class="form-group">
                            <select class="selectpicker form-control" title="是否处理"  name="status">
                                <option value="0" @if(app('request')->get('status') === 0 || app('request')->get('status') === '0') selected @endif>未处理</option>
                                <option value="1" @if(app('request')->get('status') == 1) selected @endif>已处理</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>搜索</button>
                        <a href="{{ route('admin.member.feedback') }}" class="btn btn-default"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>重置</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-body">
                    <table id="tags-table" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th colspan="8"><button class="btn btn-default is-batch" type="button">批量处理</button></th>
                        </tr>
                        </thead>
                        <thead>
                        <tr>
                            <th><label><input type="checkbox" name="select-all">全选</label></th>
                            <th>ID</th>
                            <th>用户UID</th>
                            <th>用户账号</th>
                            <th>反馈内容</th>
                            <th>处理状态</th>
                            <th>添加时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($datas->count())
                            @foreach($datas as $v)
                                <tr>
                                    <td>@if($v->status != 1)<input type="checkbox" name="select-box" value="{{$v->id}}">@endif</td>
                                    <td>{{$v->id}}</td>
                                    <td>{{$v->user_id}}</td>
                                    <td>{{$v->user?($v->user->mobile?:$v->user->email):''}}</td>
                                    <td>{{$v->content}}</td>
                                    <td>
                                        @if($v->status == 1)
                                            <span class="btn btn-sm btn-success">已处理</span>
                                        @else
                                            <span class="btn btn-sm btn-primary">未处理</span>
                                        @endif
                                    </td>
                                    <td>{{$v->created_at}}</td>
                                    <td>
                                        <a style="margin:3px;"  href="javascript:;" class="btn-xs text-success feedback-deal" data-id="{{$v->id}}"><i class="fa fa-edit"></i>处理</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center">暂无数据</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    {{$datas->appends($input)->links()}}
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        var checkAll =$('input[name=select-all]');  //全选的input
        var checkboxs =$('input[name=select-box]'); //所有单选的input

        checkAll.on('ifChecked ifUnchecked',function(event){
            if(event.type == 'ifChecked'){
                checkboxs.iCheck('check');
            }else{
                checkboxs.iCheck('uncheck');
            }
        });

        checkboxs.on('ifChanged',function(event){
            if(checkboxs.filter(':checked').length == checkboxs.length){
                checkAll.prop('checked',true);
            }else{
                checkAll.prop('checked',false);
            }
            checkAll.iCheck('update');
        });
        $('.feedback-deal').click(function () {
            var _this = $(this);
            feedback(_this.attr('data-id'));
        });
        //批量审核
        $('.is-batch').click(function () {
            var _this = $(this);
            var id = '';
            $("input[name=select-box]:checked").each(function(index, value){
                id += $(value).val() + ',';
            });
            if (!id){
                alert('请选择用户回馈序号');
                return ;
            }
            id = id.substr(0, id.length - 1);
            feedback(id)
        });
        function feedback(id){
            $.ajax({
                type : 'POST',
                url : "{{ route('admin.member.feedbackstatus') }}",
                data : { id : id},
                dataType : 'json',
                success : function (json) {
                    if (json.status == 1){
                        toastr.success(json.message,'');
                        window.location.reload();
                    }else{
                        toastr.error(json.message,'');
                    }
                }
            });
        }
    </script>
@endsection