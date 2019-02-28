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
                            <th>批量审核</th>
                            <th colspan="8">
                                @foreach($goods_status as $k => $v)
                                    <button class="btn btn-default is-batch" type="button" data-status="{{ $k }}">{{ $v }}</button>
                                @endforeach
                            </th>
                        </tr>
                        </thead>
                        <thead>
                        <tr>
                            <th><label><input type="checkbox" name="select-all">全选</label></th>
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
                                <td><input type="checkbox" name="select-box" value="{{$v->id}}"></td>
                                <td>{{$v->id}}</td>
                                <td><a href="javascript:;" data-toggle="tooltip" title="{{$v->long_title}}">{{$v->title}}</a></td>
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
@section('js')
    <script>
//        //给全选的复选框添加事件
//        $("input[name=select-all]").click(function(){
//            // this 全选的复选框
//            var userids=this.checked;
//            //获取name=select-box的复选框 遍历输出复选框
//            $("input[name=select-box]").each(function(){
//                this.checked=userids;
//            });
//        });
//
//        //给name=select-box的复选框绑定单击事件
//        $("input[name=select-box]").click(function(){
//            //获取选中复选框长度
//            var length=$("input[name=select-box]:checked").length;
//            //未选中的长度
//            var len=$("input[name=select-box]").length;
//            if(length==len){
//                $("input[name=select-all]").get(0).checked=true;
//            }else{
//                $("input[name=select-all]").get(0).checked=false;
//            }
//        });
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
        //批量审核
        $('.is-batch').click(function () {
            var _this = $(this);
            var id = '';
            $("input[name=select-box]:checked").each(function(index, value){
                id += $(value).val() + ',';
            });
            if (!id){
                alert('请选择商品序号');
            }
            id = id.substr(0, id.length - 1);
            $.ajax({
                type : 'POST',
                url : "{{ route('admin.goods.save') }}",
                data : { id : id, status : _this.attr('data-status'), is_batch:1},
                dataType : 'json',
                success : function (json) {
                    alert(json.message);
                    if (json.status == 1){
                        window.location.reload();
                    }
                }
            });
        })
    </script>
@endsection

