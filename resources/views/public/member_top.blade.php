<div class="small-nav">
    <a href="{{ route('member.publishing.product.index') }}"  @if($current_controller_array[0] == 'member' && $current_controller_array[1] == 'publishing' && $current_controller_array[2] == 'product') class="active-title" @endif>产品研发榜</a>
    <a href="{{ route('member.publishing.issueDemand.index') }}" @if($current_controller_array[0] == 'member' && $current_controller_array[1] == 'publishing' && $current_controller_array[2] == 'issueDemand') class="active-title" @endif>发行需求榜</a>
    <a href="{{ route('member.publishing.channelDemand.index') }}" @if($current_controller_array[0] == 'member' && $current_controller_array[1] == 'publishing' && $current_controller_array[2] == 'channelDemand') class="active-title" @endif>渠道需求榜</a>
    <a href="{{ route('member.publishing.outsource.index') }}" @if($current_controller_array[0] == 'member' && $current_controller_array[1] == 'publishing' && $current_controller_array[2] == 'outsource') class="active-title" @endif>外包供需榜</a>
    <a href="{{ route('member.publishing.openTest.index') }}" @if($current_controller_array[0] == 'member' && $current_controller_array[1] == 'publishing' && $current_controller_array[2] == 'openTest') class="active-title" @endif>游戏开测榜</a>
</div>
<style>
    .small-nav a{
        margin-right: 56px;
    }
</style>