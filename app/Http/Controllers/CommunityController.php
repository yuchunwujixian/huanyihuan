<?php
/**
 * -----------------------------------------
 * Desc: 社区控制器
 * User: Jiafang.Wang
 * Date: 2017/3/30
 * Time: 10:04
 * File: CommunityController.php
 * Project: www
 * -----------------------------------------
 */


namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\PostReport;
use App\Models\PostAttach;
use App\Models\PostCollect;
use App\Models\PostPoint;
use App\Models\User;
use Auth;
use App\Models\Post;
use Symfony\Component\HttpFoundation\Request;
use Toastr;

class CommunityController extends Controller
{
    /**
     * @name index
     * @desc  社区首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/3/30 10:07
     * @update 2017/3/30 10:07
     */
    public function index(Request $request)
    {
        if(Auth::check()) {
            $user_info = $request->user();
        } else {
            $user_info = [];
        }
        $posts = Post::where(['status' => 1])->orderBy('id', 'desc')->paginate(15);
        return view('community.index', [
            'posts' => $posts,
            'user_info' => $user_info,
        ]);
    }


    /**
     * @desc 保存发帖
     * @param Request $request
     * @since 2017/4/29 22:37
     * @author Jiafang.Wang
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storePost(Request $request)
    {
        $user_id = Auth::user()->id;
        $store_data = [
            'user_id' => $user_id,
            'content' => $request->input('content'),
            'status' => 1,
            'is_anonymity' => $request->input('is_anonymity', 0)
        ];
        $post_model = Post::create($store_data);

        if($request->input('community_post_img_url')) {
            $url_data = explode(',', $request->input('community_post_img_url'));
            $insert_data = [];
            foreach ($url_data AS $url) {
                array_unshift($insert_data, [
                    'user_id' => $user_id,
                    'post_id' => $post_model->id,
                    'url' => $url,
                ]);
            }
            $lastInsertId = PostAttach::insert($insert_data);
        }

        Toastr::success('发布成功');

        return redirect()->route('community.index');
    }

    /**
     * @desc 保存评论AJAX
     * @param Request $request
     * @since 2017/4/29 22:37
     * @author Jiafang.Wang
     */
    public function storeCommentAjax(Request $request)
    {
        $store_data = [
            'user_id' => Auth::user()->id,
            'post_id' => $request->input('post_id'),
            'content' => $request->input('content'),
            'is_anonymity' => $request->input('is_anonymity'),
        ];
        $last_insert_id = Comment::create($store_data);
        if($last_insert_id) {
            Post::where('id', $request->input('post_id'))->increment('comments');
            exit('发布成功');
        } else {
            exit('发布失败');
        }
    }

    /**
     * @name myReleasePosts
     * @desc 我的发布
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/3/30 13:50
     * @update 2017/3/30 13:50
     */
    public function myReleasePosts(Request $request)
    {
        if(Auth::check()) {
            $user_info = $request->user();
            $posts = Post::where(['user_id' => $user_info->id])->orderBy('id', 'desc')->paginate(10);
        } else {
            $user_info = [];
            $posts = [];
        }
        return view('community.my_posts', [
            'posts' => $posts,
            'user_info' => $user_info,
        ]);
    }


    /**
     * @name myCollectsPosts
     * @desc 用户收藏的帖子
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/3/30 16:49
     * @update 2017/3/30 16:49
     */
    public function myCollectsPosts(Request $request)
    {
        $user_id = $request->user()->id;
        $collect_posts = User::find($user_id)->collectPostsInfo()->paginate(10);
        return view('community.my_collect_posts', [
            'posts' => $collect_posts,
            'user_info' => $request->user()
        ]);
    }


    /**
     * @name myPointPosts
     * @desc  我点赞的帖子
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/3/30 16:51
     * @update 2017/3/30 16:51
     */
    public function myPointPosts(Request $request)
    {
        $user_id = $request->user()->id;
        $posts = PostPoint::where(['user_id' => $user_id])->with('post')->orderBy('created_at', 'desc')->get();
        return view('community.my_point_posts', ['posts' => $posts]);
    }

    /**
     * @name storePoints
     * @desc 点赞以及取消功能
     * @param Request $request
     * @return mixed
     * @since  2017/05/02
     * @update 2017/05/02
     */
    public function storePoints(Request $request)
    {
        $data['user_id'] = $request->user()->id;
        $data['post_id'] = $request->input('post_id');
        $status = $request->input('status');
        $info = PostPoint::where($data)->first();
        $post = Post::find($data['post_id']);
        if ($status == 1) {
            $post->decrement('points', 1);
            $res = PostPoint::destroy($info['id']);
        } else {
            if ($info) {
                $date['code'] = 0;
                $date['message'] = "您已点赞，不能重复操作！！！";
                return $date;
            }
            $post->increment('points', 1);
            $res = PostPoint::insert($data);
        }
        if($res) {
            $date['code'] = 0;
            $date['message'] = "操作成功！！！";
            return $date;
        } else {
            $date['code'] = 1;
            $date['message'] = "操作失败，请重试！！！";
            return $date;
        }
    }

    /**
     * @name storeCollects
     * @desc 收藏以及取消功能
     * @param Request $request
     * @return mixed
     * @since  2017/05/02
     * @update 2017/05/02
     */
    public function storeCollects(Request $request)
    {
        $data['user_id'] = $request->user()->id;
        $data['post_id'] = $request->input('post_id');
        $status = $request->input('status');
        $info = PostCollect::where($data)->first();
        $post = Post::find($data['post_id']);
        if ($status == 1) {
            $post->decrement('collects', 1);
            $res = PostCollect::destroy($info['id']);
        } else {
            if ($info) {
                $date['code'] = 0;
                $date['message'] = "您已收藏，不能重复操作！！！";
                return $date;
            }
            $post->increment('collects', 1);
            $res = PostCollect::insert($data);
        }
        if($res) {
            $date['code'] = 0;
            $date['message'] = "操作成功！！！";
            return $date;
        } else {
            $date['code'] = 1;
            $date['message'] = "操作失败，请重试！！！";
            return $date;
        }
    }


    /**
     * @desc 待解决 TODO
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author Jiafang.wang
     * @since 2017/5/12 17:55
     */
    public function myCommentPosts(Request $request)
    {
        $user_id = $request->user()->id;
        $posts =   User::find($user_id)->commentPostsInfo()->paginate(10);
//        var_dump($posts);die;
        return view('community.my_collect_posts', [
            'posts' => $posts,
            'user_info' => $request->user()
        ]);
    }

    /**
     * @name destroy
     * @desc  删除发布的帖子
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/6/12 15:22
     * @update 2017/6/12 15:22
     */
    public function destroy(Request $request, $id)
    {
        $user_id = $request->user()->id;
        $res =  Post::where(['user_id' => $user_id, 'id' => $id])->delete();
        if ($res) {
            PostPoint::where('post_id', $id)->delete();
            PostCollect::where('post_id', $id)->delete();
            PostReport::where('post_id', $id)->delete();
            Comment::where('post_id', $id)->delete();
            $postAttaches = PostAttach::where('post_id', $id)->get();
            foreach ($postAttaches as $value) {
                @unlink(public_path($value->url));
            }
            PostAttach::where('post_id', $id)->delete();
            Toastr::success('删除成功');
            return back();
        } else {
            Toastr::error('删除失败');
            return back();
        }
    }
}
