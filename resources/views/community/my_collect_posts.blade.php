@extends('public.base')

@section('title','炯米社区')

@section('css')
  <link rel="stylesheet" href="/dist/css/community/community.css">
  <style type="text/css">

      .imgone{
          width: 100% !important;vertical-align: middle;cursor:pointer;
      }
      .exampleone{
          width: 166px;height: 166px;line-height: 166px;margin: 20px 2px;
      }
      .on{cursor:pointer;}

      .on>img{width:400px !important;position: fixed;top:30%;left: 35%;}

  </style>
@endsection

@section('content')
  <!-- banner图 -->
  <div class="banner">
    <img src="/dist/img/connect-banner.png">
  </div>
  <!-- 内容区域 -->
  <div class="container">
    <!-- 用户基本信息 -->
    <div class="user-basic-info">
        @include('public.community_header')
    </div>
    <!-- 说点什么 -->
    {{--<form class="say-form" action="{{route('community.post.store')}}" method="post">--}}
      {{--{{csrf_field()}}--}}
      {{--<textarea class="say-somthing" placeholder="说点什么吧！" name="content"></textarea>--}}
      {{--<div class="deliver-something" style="height: 45px;padding-top: 5px; padding-right: 5px">--}}
        {{--<div class="img-upload">--}}
          {{--<input id="upload_company_logo" class="upload_button" style="margin-top: 10px" type="button" value="本地上传"/>--}}
          {{--<input type="hidden" name="community_post_img_url">--}}
        {{--</div>--}}
        {{--<div style="float: left; margin-left: 100px; margin-top: 10px">可最多上传十张，jpg/png类型图片</div>--}}
        {{--<div class="comment-anonymous inline-block">--}}
          {{--<input type="checkbox" name="is_anonymity" value="1" id="comment-anonymous" class="inline-block" />--}}
          {{--<label for="comment-anonymous">匿名</label>--}}
        {{--</div>--}}
        {{--<div class="comment-btn inline-block">--}}
          {{--@if(Auth::check())--}}
            {{--<input type="submit" value="发表">--}}
          {{--@else--}}
            {{--<input type="button" value="发表" onclick="window.location.href='{{route('login')}}'">--}}
          {{--@endif--}}
        {{--</div>--}}
      {{--</div>--}}
      {{--style="margin-top: 30px;height: 135px"--}}
      {{--<style>#community_photos_lists img {width: 120px; height: 120px; margin-bottom: 5px; margin-left: 5px}</style>--}}
      {{--<div id="community_photos_lists"></div>--}}
    {{--</form>--}}
    <!-- comment -->
    @if($posts)
          <style>.comment {overflow: inherit}</style>
      <div class="comment">
        <!-- 一条评论 -->
        @foreach($posts as $post)
          <div class="one-comment">
            <div class="comment-content" style="height: 100%">
              <div class="comment-avatar inline-block">
                @if($post->is_anonymity)
                  <img width="54px" height="54px" src="/dist/img/avatar.png" />
                @else
                  <img width="54px" height="54px" src="{{$post->userInfo->avatar}}" />
                @endif
              </div>
              <div class="cemment-user-info inline-block">
                <div class="cemment-user-name">
                  @if($post->is_anonymity)
                    炯米用户
                  @else
                    {{$post->userInfo->name}}
                  @endif
                  <span style="float: right">
                    @if($post->status) <span style="color: green;font-weight: bold">审核通过</span> @else <span style="color: red">待审核</span> @endif
                  </span>
                </div>
                <div class="cemment-user-time">
                  {{$post->created_at}}
                </div>
                <div class="comment-user-content">
                  {{$post->content}}
                </div>
              </div>
            </div>
              @if($post->attachesInfo->toArray())
                  <style>
                      .comment-about {padding-top: 10px}
                      .example {padding: 10px}
                      .example img {width: auto; max-width: 200px}
                  </style>
                  <div class="comment-about">
                      <div class="comment-about-img">
                          @foreach($post->attachesInfo as $attach)
                              <div class="inline-block exampleone">
                                  <img src="{{$attach->url}}" class="imgone"/>
                              </div>
                          @endforeach
                      </div>
                  </div>
              @endif
            <div class="comment-operation">
              <input type="hidden" name="post_id" value="{{ $post->id }}">
              @if(Auth::check())
                @if ($post->isPointPost(Auth::user()->id, $post->id) > 0)
                  <div class="inline-block praise" data-index="1" style="color: #247dc1">
                    <i class="icon iconfont icon-zan1"></i> 已点赞
                  </div>
                @else
                  <div class="inline-block praise" data-index="2">
                    <i class="icon iconfont icon-zan1"></i> 点赞
                  </div>
                @endif
                <div class="inline-block discuss">
                  <i class="icon iconfont icon-pinglun"></i> 评论
                </div>

                @if ($post->isCollectPost(Auth::user()->id, $post->id) > 0)
                  <div class="inline-block collect" style="color: #247dc1" data-index="1">
                    <i class="icon iconfont icon-star"></i> 已收藏
                  </div>
                @else
                  <div class="inline-block collect" data-index="12">
                    <i class="icon iconfont icon-star"></i> 收藏
                  </div>
                @endif
              @else
                <div class="inline-block" onclick="window.location.href='{{route('login')}}'">
                  <i class="icon iconfont icon-zan1"></i> 点赞
                </div>
                <div class="inline-block" onclick="window.location.href='{{route('login')}}'">
                  <i class="icon iconfont icon-pinglun"></i> 评论
                </div>
                <div class="inline-block" onclick="window.location.href='{{route('login')}}'">
                  <i class="icon iconfont icon-star"></i> 收藏
                </div>
              @endif
              <div class="inline-block report">
                <i class="icon iconfont icon-jubao"></i> 举报
              </div>
            </div>
            <!-- 该部分注意id重复问题，因此在id后加上index用于区分 -->
            <div id="discuss{{$post->id}}" style="display: none">
              <div class="comment-discuss">
                <input type="text"  name="comment_content_{{$post->id}}"  class="discuss-content" placeholder="我也来说上一说！！！" />
                <span class="inline-block discuss-nick-name">
                                  <input type="radio" value="1" name="comment_content_{{$post->id}}_radio" class="inline-block anonymous" />
                                  <label for="anonymous0">匿名</label>
                          </span>
                <input class="inline-block discuss-btn" type="button" data-index="{{$post->id}}" name="comment_content_submit" value="确定" />
              </div>
              <div class="discuss-all">
                @foreach($post->commentsInfo as $comment)
                  <div class="one-discuss">
                    @if($comment->is_anonymity)
                      <img class="inline-block" src="/dist/img/community-user-avatar.png" />
                    @else
                      <img class="inline-block" src="{{$comment->userInfo->avatar}}" />
                    @endif
                    <div class="inline-block">
                      <div class="one-discuss-content">
                        @if($comment->is_anonymity)
                          <span>炯米用户:</span>
                        @else
                          <span>{{$comment->userInfo->name}}:</span>
                        @endif
                        {{$comment->content}}
                      </div>
                      <div class="one-discuss-time">
                        {{$comment->created_at}}
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <style>
        .page {margin-top: 60px; padding-bottom: 60px}
        .page ul li {float: left; width: 25px}
        .page ul li a {font-size: 14px}
      </style>
      <div class="page">
        {{ $posts->links() }}
      </div>
    @else
      您还未发布
    @endif
  </div>
@endsection
@section('js')
  <script src="/dist/js/community/community.js"></script>
  <link href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
  <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
  <link rel="stylesheet" type="text/css" href="/plugins/uploadify_3.2.1/uploadify.css">
  <script type="text/javascript" src="/plugins/uploadify_3.2.1/jquery.uploadify.js"></script>
  <script>
      $("input[name='comment_content_submit']").click(function () {
          var data_index = $(this).attr('data-index');
          var comment_content = $("input[name='comment_content_"+ data_index +"']").val();
          var is_anonymous = $('input:radio[name="comment_content_'+ data_index +'_radio"]:checked').val();
          if(comment_content.length < 1) {
              toastr.error('请输入评论内容');
              return false;
          }
          if(is_anonymous == null) {
              is_anonymous = 0;
          }
          $.post(
              "{{route('community.comment.store')}}",
              {'_token' : "{{csrf_token()}}", 'content': comment_content, 'post_id': data_index, 'is_anonymity': is_anonymous},
              function (data) {
                  toastr.success('评论成功','');
                  window.location.reload();
              }
          );
      });

      $(".praise").click(function () {
          var status = $(this).attr('data-index');
          var post_id = $(this).parent().children(0).val();
          var self = $(this);
          $.ajax({
              url:"{{ route('community.points.store') }}",
              type:"POST",
              dataType : 'json',
              data:{"status" : status, "post_id" : post_id, '_token' : "{{csrf_token()}}"},
              success : function(data) {
                  if (data.code == 0) {
                      if (status == "1"){
                          self.attr('data-index', 2)
                          self.css({ color: "#666" });
                      } else {
                          self.attr('data-index', 1)
                          self.css({ color: "#247dc1" });
                      }
                      toastr.success(data.message,'');
                  } else {
                      toastr.error(data.message,'');
                  }
              }
          })
      });

      $(".collect").click(function () {
          var status = $(this).attr('data-index');
          var post_id = $(this).parent().children(0).val();
          var self = $(this);
          $.ajax({
              url:"{{ route('community.collects.store') }}",
              type:"POST",
              dataType : 'json',
              data:{"status" : status, "post_id" : post_id, '_token' : "{{csrf_token()}}"},
              success : function(data) {
                  if (data.code == 0) {
                      if (status == "1"){
                          self.attr('data-index', 2)
                          self.css({ color: "#666" });
                      } else {
                          self.attr('data-index', 1)
                          self.css({ color: "#247dc1" });
                      }
                      toastr.success(data.message,'');
                  } else {
                      toastr.error(data.message,'');
                  }
              }
          })
      });

  </script>
  <script>
      $("#upload_company_logo").uploadify({
          'formData': {
              'target' : 'community',    //上传至public/uploads目录下的子目录
              '_token'     : "{{csrf_token()}}"
          },
          'buttonClass'        :    'upload',
          'fileSizeLimit'        :    '2MB',
          'fileTypeDesc'        :     '选择图片',
          'fileTypeExts'         :     '*.jpg;*.png',
          'height'            :    '30',
          'width'                :    '100',
          'method'            :    'post',
          'multi'                :     false,
          'swf'                :    '/plugins/uploadify_3.2.1/uploadify.swf',
          'uploader'            :    "{{route('upload.images')}}",
          'uploadLimit'        :  10,
          'buttonText'        :    '上传图片',
          'onUploadSuccess'    :    function(file, data){
              $('#community_photos_lists').append('<img src="'+ data +'" />');
              var comapny_e_url = $("input[name='community_post_img_url']");
              if(comapny_e_url.val().length > 0) {
                  var c =  comapny_e_url.val() + ',' + data;
              } else {
                  var c = data;
              }
              comapny_e_url.val(c);
          }
      });
      $('.exampleone').hover(function() {
                  $(this).addClass('on');
              },
              function() {
                  $(this).animate({
                              height: "166px"
                          },
                          100).removeClass('on');
              });
  </script>
@endsection