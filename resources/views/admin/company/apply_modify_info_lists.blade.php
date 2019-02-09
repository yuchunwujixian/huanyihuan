@extends('admin.layouts.base')

@section('title','公司管理')

@section('pageHeader','申请修改公司信息列表')

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
                <th class="hidden-sm">申请者</th>
                <th class="hidden-sm">要修改的公司</th>
                <th class="hidden-sm">申请理由</th>
                <th class="hidden-md">状态</th>
                <th class="hidden-md">创建日期</th>
                <th class="hidden-md">操作</th>
              </tr>
            </thead>
            <tbody>
            @if($lists->count())
            @foreach($lists as $v)
              <tr>
                <td>{{$v->id}}</td>
                <td>{{$v->userInfo->name}}</td>
                <td>{{$v->companyInfo->title}}</td>
                <td>{{$v->reason}}</td>
                <td>
                  @if($v->status == 1)
                    <button type="button" class="btn btn-primary btn-xs">申请结束
                  @else
                    <button type="button" class="btn btn-danger btn-xs">申请中
                  @endif
                    </button>
                </td>
                <td>{{$v->created_at}}</td>
                <td><a class="btn btn-primary btn-xs" href="{{route('admin.company.update', array('company_id' => $v->company_id))}}">去修改</a> </td>
              </tr>
            @endforeach
              @else
              <tr>
                <td colspan="5">暂无信息</td>
              </tr>
            @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@stop

