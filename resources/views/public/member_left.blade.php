<style>
    .active-nav a {color: #FFFFFF}
    .left-nav .active-nav {background-color: #dbe2e8}
</style>
<div class="left-nav">
    <div class="avatar-border" id="user_avatar">
        @if(Auth::user()->avatar)
            <img src="{{Auth::user()->avatar}}">
        @else
            <img src="/dist/img/connect-avatar.png">
        @endif
    </div>
    <div class="user-name">{{Auth::user()->name}}</div>
    <p @if($current_controller_array[0] == 'member' && $current_controller_array[1] == 'info') class="active-nav" style="background-color: #2370c0" @endif><a href="{{route('member.info.index')}}">基本资料</a></p>
    <p @if($current_controller_array[0] == 'member' && $current_controller_array[1] == 'integral') class="active-nav" style="background-color: #2370c0" @endif><a href="{{route('member.integral.index')}}">我的积分@if(Auth::user()->messages(Auth::user()->id))<font color="red">({{ Auth::user()->messages(Auth::user()->id) }})</font>@endif</a></p>
    <p @if($current_controller_array[0] == 'member' && $current_controller_array[1] == 'company') class="active-nav" style="background-color: #2370c0" @endif><a href="{{route('member.company.index')}}">公司信息@if(!empty(Auth::user()->companyInfo->view_status))<font color="red">(1)</font>@endif</a></p>
    <p @if($current_controller_array[0] == 'member' && $current_controller_array[1] == 'job') class="active-nav" style="background-color: #2370c0" @endif><a href="{{route('member.job.index')}}">人才招聘</a></p>
    <p @if($current_controller_array[0] == 'member' && $current_controller_array[1] == 'publishing') class="active-nav" style="background-color: #2370c0" @endif><a href="{{route('member.publishing.product.index')}}">发布需求</a></p>
</div>