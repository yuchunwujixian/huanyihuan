@extends('admin.layouts.base')

@section('title', $title)

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">为<span class="text-danger">{{ $data->title }}</span>分配商品</h3>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="box-body">
                    <form class="form-inline" role="form">
                        <div class="form-group">
                            <label>商品名称</label>
                            <input type="text" class="form-control" name="search_title" value="{{ app('request')->get('search_title') }}" placeholder="商品名称，模糊查询">
                        </div>
                        &nbsp;&nbsp;
                        <div class="form-group">
                            <select class="selectpicker form-control"  name="category_id">
                                <option value="0">商品分类</option>
                                @foreach($categories as $v)
                                    <option value="{{$v->id}}" @if($v->parent_id == 0)disabled @endif
                                    @if($v->id == app('request')->get('category_id')) selected @endif>
                                        @for($i=0;$i<$v->depth;$i++)
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                        @endfor
                                        {{$v->title}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>搜索</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="panel-body">
            @include('admin.partials.errors')
            @include('admin.partials.success')
            <form  role="form" method="POST"
                  action="{{ route('admin.topic.savegoods', ['id' => $data->id]) }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <div class="form-group">
                        @foreach($lists as $v)
                            <label class="cursor">
                                <input class="form-actions"
                                       @if(in_array($v['id'], $has_goods))
                                       checked
                                       @endif
                                       type="Checkbox" value="{{$v['id']}}"
                                       name="goods_ids[]">
                                {{ '(' . $v['id'] . ')' . $v['title']}}
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="form-group" style="margin-bottom: 0">
                    <button type="submit" class="btn btn-primary btn-md">
                        <i class="fa fa-plus-circle"></i>
                        保存
                    </button>
                </div>
                <div class="form-group" style="margin-top: -20px">
                    <div class="text-right">
                        {{ $lists->appends($param)->links() }}
                    </div>
                </div>

            </form>

        </div>
        <div class="panel-footer">
            <div class="text-green">删除专题商品，请输入商品id，多个商品用英文逗号隔开</div>
            <form class="form-inline" role="form" method="POST"
                  action="{{ route('admin.topic.delgoods', ['id' => $data->id]) }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label>商品id</label>
                    <input type="text" class="form-control" name="goods_id" placeholder="商品名称id">
                </div>
                &nbsp;&nbsp;
                <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>删除</button>
            </form>
        </div>
    </div>
@stop