<!--已登录-->
@if($user_info)
  <div class="user-avatar">
    @if($user_info->avatar)<img src="{{$user_info->avatar}}" />@else<img src="/dist/img/connect-avatar.png" />@endif
  </div>
  <div class="user-text-info">
    <div class="user-name">
      <div class="uname-show inline-block">
        {{$user_info->name}}-
        @if($user_info->position) {{$user_info->position}} @else 暂未填写职位 @endif -
        @if($user_info->companyInfo) {{$user_info->companyInfo->title}} @else 暂未填写公司信息 @endif
      </div>
    </div>

    <style>.edit-one-item{width: 15%}</style>
    <div class="edit-items">
      <div class="edit-one-item inline-block">
        <a href="{{route('community.index')}}">
          <i class="icon iconfont icon-plane  inline-block"></i>
          <span class="inline-block" @if($current_controller_array[0] == 'community' && $current_controller_array[1] == 'index') style="color: blue;font-weight: bold;" @endif>
              我要发布
            </span>
        </a>
      </div>

      <div class="edit-one-item inline-block">
        <a href="{{route('community.posts.my')}}">
          <i class="icon iconfont icon-plane  inline-block"></i>
          <span class="inline-block" @if($current_controller_array[0] == 'community' && $current_controller_array[1] == 'posts') style="color: blue;font-weight: bold;" @endif>
              我的发布
            </span>
        </a>
      </div>
      <div class="edit-one-item inline-block">
        <a href="{{route('community.collects.my')}}">
          <i class="icon iconfont icon-star inline-block"></i>
          <span class="inline-block" @if($current_controller_array[0] == 'community' && $current_controller_array[1] == 'collects') style="color: blue;font-weight: bold;" @endif>我的收藏</span>
        </a>
      </div>
      <div class="edit-one-item inline-block">
        <a href="{{route('community.comments.my')}}">
          <i class="icon iconfont icon-woshou inline-block"></i>
          <span class="inline-block" @if($current_controller_array[0] == 'community' && $current_controller_array[1] == 'comments') style="color: blue;font-weight: bold;" @endif>我的参与</span>
        </a>
      </div>
    </div>

  </div>
  <!--未登录-->
@else
  <div class="user-avatar">
    <img src="/dist/img/connect-avatar.png" />
  </div>
  <div class="user-text-info">
  </div>
@endif


