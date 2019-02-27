@extends('admin.layouts.base')

@section('title', $title)

@section('css')
    {{--图标--}}
    <link rel="stylesheet" href="/plugins/bootstrap-iconpicker/icon-fonts/font-awesome-4.2.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="/plugins/bootstrap-iconpicker/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css"/>
@stop

@section('content')
    <div class="row" style="margin-bottom: 5px">
        <div class="col-md-6">
            <a href="{{ route('admin.category.create')}}" class="btn btn-success btn-md"><i class="fa fa-plus-circle"></i> 添加商品分类 </a>
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
                            <th class="hidden-sm">职位名称</th>
                            <th data-sortable="false">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lists as $category)
                                @if($category->parent_id)
                                    <tr class="treegrid-{{$category->id}} treegrid-parent-{{$category->parent_id}}">
                                @else
                                    <tr class="treegrid-{{$category->id}}">
                                @endif
                                    <td>
                                        @for($i=0;$i<$category->depth;$i++)
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                        @endfor
                                        {{$category->title}}
                                    </td>
                                    <td>

                                        <a href="{{route('admin.category.update', array('id' => $category->id))}}">编辑</a>
                                        <a href="{{route('admin.category.del', array('id' => $category->id))}}">删除</a>
                                    </td>
                                </tr>
                         @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop
@section('js')
    <script type="text/javascript" src="/plugins/bootstrap-iconpicker/bootstrap-iconpicker/js/iconset/iconset-fontawesome-4.3.0.min.js"></script>
    <script type="text/javascript" src="/plugins/bootstrap-iconpicker/bootstrap-iconpicker/js/bootstrap-iconpicker.js"></script>
    <link rel="stylesheet" href="/plugins/jquery-treegrid/css/jquery.treegrid.css">
    <script src="/plugins/jquery-treegrid/js/jquery.treegrid.min.js"></script>
    <script>
        $('.caret').remove();
        $('.btn-default').removeClass('iconpicker');
        $('.btn-default').unbind('click');
        $('#tags-table').treegrid();
    </script>
@stop
