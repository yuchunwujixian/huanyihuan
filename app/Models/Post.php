<?php
/**
 * -----------------------------------------
 * Desc: 社区-帖子模型类
 * User: Jiafang.Wang
 * Date: 2017/3/30
 * Time: 9:23
 * File: Post.php
 * Project: www
 * -----------------------------------------
 */


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'content', 'user_id', 'status', 'is_anonymity',  'points', 'collects', 'comments'
    ];

    /**
     * @name userInfo
     * @desc 职位对应的发布者信息
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @since  2017/3/30 9:24
     * @update 2017/3/30 9:24
     */
    public function userInfo()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }


    /**
     * @name commentsInfo
     * @desc 帖子对应的评论信息
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @since  2017/3/30 9:28
     * @update 2017/3/30 9:28
     */
    public function commentsInfo()
    {
        return $this->hasMany('App\Models\Comment', 'post_id', 'id');
    }

    /**
     * @name isPointPost
     * @desc 登录用户是否点赞该帖子
     * @param $user_id
     * @param $post_id
     * @return mixed
     * @since  2017/3/30 9:57
     * @update 2017/3/30 9:57
     */
    public function isPointPost($user_id, $post_id)
    {
        return PostPoint::where(['user_id' => $user_id, 'post_id' => $post_id])->count();
    }

    /**
     * @name isCollectPost
     * @desc 登录用户是否收藏该帖子
     * @param $user_id
     * @param $post_id
     * @return mixed
     * @since  2017/3/30 10:02
     * @update 2017/3/30 10:02
     */
    public function isCollectPost($user_id, $post_id)
    {
        return PostCollect::where(['user_id' => $user_id, 'post_id' => $post_id])->count();
    }

    /**
     * @name postReports
     * @desc  被举报次数
     * @param $post_id
     * @return mixed
     * @since  2017/05/02
     * @update 2017/05/02
     */
    public function postReports($post_id)
    {
        return PostReport::where(['post_id' => $post_id])->count();
    }

     /**
     * @desc  附件图片
     * @since 2017/5/2 22:05
     * @author Jiafang.Wang
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attachesInfo()
    {
        return $this->hasMany('App\Models\PostAttach', 'post_id', 'id');
    }

    /**
     * @desc
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @author Jiafang.wang
     * @since 2017/5/12 17:52
     */
    public function collectUserInfo()
    {
        return $this->belongsToMany('App\Model\User', 'post_collects', 'post_id', 'user_id');
    }
}