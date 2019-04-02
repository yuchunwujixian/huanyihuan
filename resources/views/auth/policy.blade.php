@extends('public.base')

@section('title', $title)
@section('css')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            @if(isset($policy)){!! $policy !!}@else 暂无数据@endif
        </div>
    </div>
@endsection
