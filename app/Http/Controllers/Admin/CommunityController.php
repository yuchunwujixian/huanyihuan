<?php
/**
 * --------------------------------------------
 * Desc：后台社区管理
 * User: Bencai.Zhao
 * Date: 2017/5/2
 * Time: 21:56
 * File: CommunityController.php
 * --------------------------------------------
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\PostPoint;
use App\Models\PostCollect;
use App\Models\PostReport;
use App\Models\Comment;
use App\Models\PostAttach;

class CommunityController extends Controller
{
    /**
     * @name index
     * @desc  帖子列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/05/02
     * @update 2017/05/02
     */
    public function index()
    {
        $data = Post::orderBy('id', 'desc')->get();
        return view('admin.community.index', [
        'data' => $data,
        ]);
    }

    /**
     * @name update
     * @desc 查看帖子
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @since  2017/05/02
     * @update 2017/05/02
     */
    public function update($id)
    {
        $data = Post::find($id);
        return view('admin.community.edit', [
            'data' => $data,
        ]);
    }

    /**
     * @name store
     * @desc  修改帖子状态
     * @param Request $request
     * @return $this
     * @since  2017/05/02
     * @update 2017/05/02
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
        ]);
        $store_data = [
            'status' => $request->input('status'),
        ];
        $affect_rows = Post::where('id', $request->input('id'))->update($store_data);
        if($affect_rows) {
            return redirect()->route('admin.community.index')->withSuccess('更新成功');
        } else {
            return redirect()->route('admin.community.index')->withErrors('操作异常');
        }
    }

    /**
     * @name destroy
     * @desc  删除帖子
     * @param Request $request
     * @return mixed
     * @since  2017/05/02
     * @update 2017/05/02
     */
    public function destroy(Request $request)
    {
        $post_id = $request->input('id');
        $res = Post::destroy($post_id);
        if ($res) {
            PostPoint::where('post_id', $post_id)->delete();
            PostCollect::where('post_id', $post_id)->delete();
            PostReport::where('post_id', $post_id)->delete();
            Comment::where('post_id', $post_id)->delete();
            $postAttaches = PostAttach::where('post_id', $post_id)->get();
            foreach ($postAttaches as $value) {
                @unlink(public_path($value->url));
            }
            PostAttach::where('post_id', $post_id)->delete();
            $date['code'] = 0;
            $date['message'] = "删除成功！！！";
            return $date;
        } else {
            $date['code'] = 1;
            $date['message'] = "删除失败！！！";
            return $date;
        }
    }

    /**
     * @desc 评论列表
     * @param $post_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author Jiafang.wang
     * @since 2017/5/7 13:41
     */
    public function comments($post_id)
    {
        $comments = Post::find($post_id)->commentsInfo;
        return view('admin.community.comments', compact('comments'));
    }


    public function commentsDestroyAjax(Request $request)
    {
        $ret = Comment::find($request->input('comment_id'))->delete();
        if($ret) {
            Post::where('id', $request->input('post_id'))->decrement('comments');
            exit('1');
        } else {
            exit('0');
        }
    }
}
