<div id="my-point-show">
    <div class="one-title-show" style="width: 627px;">
        <span>时间</span>
        <span>需求</span>
        <span>账户</span>
        <span>状态</span>
        <span>处理</span>
        <span>客户反馈</span>
    </div>
    @if($data->count())
        @foreach($data as $v)
            <div class="one-item-show" style="width: 627px;">
                <span> {{date('Y.m.d', strtotime($v->updated_at))}}</span>
                <span>{{ str_limit($v->needs, 14) }}</span>
                <span>{{ $v->userInfo->mobile }}</span>
                <span>@if($v->status == 0) 已处理 @elseif($v->status == 1) 未处理 @else 已撤销 @endif</span>
                @if($v->handle == 1)<span> <span>已领取</span></span>  @else <span><a @if($v->status == 1) href="{{ route('member.integral.show', ['id' => $v->id]) }}" style="color: #0064bc" @else href="javascript:;" @endif>未领取</a></span> @endif
                <span>@if($v->feedback) {{ str_limit($v->feedback, 14) }} @else 暂无 @endif</span>
            </div>
        @endforeach
    @else
        <div class="one-item-show" style="width: 627px;text-align: center;padding-bottom: 10px">
            暂无数据
        </div>
    @endif
</div>