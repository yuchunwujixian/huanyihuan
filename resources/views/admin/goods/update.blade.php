@extends('admin.layouts.base')

@section('title', $title)

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ $title }}</h3>
                    </div>
                    <div class="panel-body">
                        @include('admin.partials.errors')
                        @include('admin.partials.success')
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.sides.save') }}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{$data->id}}">
                            <div class="form-group">
                                <label class="col-md-3 control-label">幻灯片标题</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="title"  value="{{$data->title}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">类型</label>
                                <div class="col-md-6">
                                    <select class="selectpicker form-control sides_type"  name="type">
                                        @foreach($sides_type as $key => $v)
                                            <option value="{{ $key }}" @if($data->type == $key) selected @endif>{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div id="sides_p_id">
                                @if($p_ids)
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">所属类别</label>
                                        <div class="col-md-6">
                                            <select class="selectpicker form-control sides_p_id"  name="p_id">
                                                @foreach($p_ids as $key => $v)
                                                    <option value="{{ $v->id }}" @if($data->p_id == $v->id) selected @endif>{{ $v->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">跳转地址</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="url" value="{{$data->url}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">图片地址</label>
                                <div class="col-md-6">
                                    {{$data->img_url}}
                                    <input type="file" class="form-control" name="file" style="border: 0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">排序</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="sort" value="0"  value="{{$data->sort}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-md-3 control-label">是否显示</label>
                                <div class="col-md-6">
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="1" @if($data->status == 1)checked @endif> 是
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="0" @if($data->status == 0)checked @endif> 否
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-7 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary">保存</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        $(document).ready(function () {
            {{--var value = "{{ key($sides_type) }}";--}}
//            shows(value);
        });
        $('.sides_type').change(function () {
            var type = $(this).val();
            shows(type);
        });
        function shows(type) {
            $.ajax({
                url : "{{ route('admin.sides.sides_type') }}",
                data : { type : type},
                dataType : 'json',
                success : function (json) {
                    if (json.status == 1){
                        //数据不存在,清除掉
                        if (json.data == null || json.data.length == 0){
                            if ($('#sides_p_id').length > 0){
                                $('#sides_p_id').html('');
                            }
                        }else{//存在则修改
                            var str = '<div class="form-group"><label class="col-md-3 control-label">所属类别</label>'+
                                '<div class="col-md-6"> <select class="selectpicker form-control sides_p_id"'+
                                ' name="p_id">';
                            $.each(json.data, function(index, val){
                                str += '<option value="'+val.id+'">'+val.name+'</option>';
                            });
                            str += '</select></div></div>';
                            $('#sides_p_id').html(str);
                            $('.sides_p_id').selectpicker();
                        }
                    }else{
                        alert(json.message)
                    }
                }
            });
        }
    </script>
@endsection