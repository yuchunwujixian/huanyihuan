<div class="list-group text-center">
    <a class="list-group-item thumbnail">
        <img class="img-thumbnail member-avatar" width="150px" src="{{ asset('storage/'.Auth::guard()->user()->avatar) }}" onerror="this.src='/img/default_avatar.png';this.onerror=null;">
        {{Auth::user()->nickname}}
    </a>
    @if(strpos(Route::currentRouteName(), 'info') !== false)
        <a class="list-group-item active disabled" href="javascript:;">基本资料</a>
    @else
        <a class="list-group-item cursor" href="{{ route('member.info.index') }}">基本资料</a>
    @endif
    @if(strpos(Route::currentRouteName(), 'goods') !== false)
        <a class="list-group-item active disabled" href="javascript:;">我的商品</a>
    @else
        <a class="list-group-item cursor" href="{{ route('member.goods.index') }}">我的商品</a>
    @endif
</div>