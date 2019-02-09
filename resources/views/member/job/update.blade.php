@extends('public.base')

@section('title','人才招聘-修改职位')

@section('uc_here', '修改职位')

@section('css')
  <link rel="stylesheet" href="/dist/css/personal/personal.css">
  <link rel="stylesheet" href="/dist/css/personal/releaserecruitment.css">
@endsection

@section('content')
@if(empty($data))
    对不起，您要修改的职位不存在！！！
@else
    @include('public.member_header')
    <!-- 内容部分 -->
    <div class="wrapper">
        @include('public.member_left')
        <div class="right-content">
            <form id="releaserecruitment-wrapper" action="{{ route('member.job.store') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id" value="{{ $data->id }}">
                <p class="one-info">
                    <span class="inline-block">职位名称</span>
                    <input type="text" id="positionName" name="title" placeholder="例如：招聘专员" value="{{ $data->title }}">
                    <label class="error">请填写发布职位</label>
                </p>
                <p class="one-info">
                    <span class="inline-block">职业分类</span>
                    <select class="inline-block" name="job_category_id" autocomplete="off" style="width: 150px">
                        <option value="请选择" disabled>请选择</option>
                        @foreach ($job_categories as $v)
                            <option value="{{ $v->id }}" @if($v->depth < 2) disabled @endif @if($v->id == $data->job_category_id) selected = "selected" @endif>
                                @for($i=0;$i<$v->depth;$i++)
                                    &nbsp;&nbsp;
                                @endfor
                                    {{ $v->title }}
                            </option>
                        @endforeach
                    </select>
                    <label class="error">请选择职业分类</label>
                </p>
                <p class="one-info">
                    <span class="inline-block">职业性质</span>
                    <select class="inline-block" name="type" autocomplete="off" style="width: 150px">
                        <option value="请选择" disabled>请选择</option>
                        @foreach ($job_config['type'] as $key => $value)
                            <option value="{{ $key }}"  @if ($key == $data->type) selected @endif>{{ $value }}</option>
                        @endforeach
                    </select>
                    <label class="error">请选择职业性质</label>
                </p>
                <p class="one-info">
                    <span class="inline-block">薪资范围</span>
                    <i class="inline-block" id="salary">
                        <input class="salary inline-block" name="salary_start" type="number" value="{{ $data->salary_start }}" />元 -
                        <input class="salary inline-block" name="salary_end" type="number" value="{{ $data->salary_end }}"/>元
                    </i>
                    <label class="error">请输入薪资范围</label>
                </p>
                <p class="one-info">
                    <span class="inline-block">经验要求</span>
                    <select class="inline-block" id="experience" name="experience">
                        <option value="请选择" disabled>请选择</option>
                        @foreach ($job_config['experience'] as $key => $value)
                            <option value="{{ $key }}" @if($key == $data->experience) selected @endif>{{ $value }}</option>
                        @endforeach
                    </select>
                    <label class="error">请选择经验要求</label>
                </p>
                <p class="one-info">
                    <span class="inline-block">学历要求</span>
                    <select class="inline-block" id="education" name="education">
                        <option value="请选择" disabled>请选择</option>
                        @foreach ($job_config['education'] as $key => $value)
                            <option value="{{ $key }}" @if($key == $data->education) selected @endif>{{ $value }}</option>
                        @endforeach
                    </select>
                    <label class="error">请选择学历要求</label>
                </p>
                <p class="one-info">
                    <span class="inline-block">福利待遇</span>
                <div class="inline-block"  style="line-height: 35px">
                    @foreach ($job_config['welfare'] as $key => $value)
                        <input type="checkbox" @if(in_array($key, explode(',', $data->temptation))) checked @endif  value="{{ $key }}" name="welfare[]">&nbsp;{{ $value }}
                    @endforeach
                </div>
                <label class="error">请选择福利待遇</label>
                </p>
                <p class="one-info">
                    <span class="inline-block">工作地点</span>
                    <input type="text" id="positionPlace" placeholder="请输入" name="work_address" value="{{ $data->work_address }}">
                    <label class="error">请填写工作地点</label>
                </p>
                <p class="one-info">
                    <span class="inline-block">工作内容</span>
                    <textarea id="positionContent" class="inline-block" placeholder="请输入工作内容" name="work_conntent" rows="8" cols="80">{{ $data->work_conntent }}</textarea>
                    <label class="error">请填写工作内容</label>
                </p>
                <p class="one-info">
                    <span class="inline-block">任职要求</span>
                    <textarea id="positionRequire" class="inline-block" placeholder="请输入任职要求" name="job_requirements" rows="8" cols="80">{{ $data->job_requirements }}</textarea>
                    <label class="error">请填写任职要求</label>
                </p>
                <input id="submit-form" type="submit" value="发布">
            </form>
        </div>
    </div>
@endif
@endsection
@section('js')
  <script src="/dist/js/personal/releaserecruitment.js"></script>
@endsection
