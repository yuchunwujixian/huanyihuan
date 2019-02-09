<?php
/**
 * -----------------------------------------
 * Desc: 社区-评论模型类
 * User: Jiafang.Wang
 * Date: 2017/3/30
 * Time: 9:23
 * File: Comment.php
 * Project: www
 * -----------------------------------------
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'post_id', 'content', 'is_anonymity'];

    /**
     * @name userInfo
     * @desc  评论人信息
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @since  2017/03/28
     * @update 2017/03/28
     */
    public function userInfo()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    /**
     * @name postInfo
     * @desc  所属帖子信息
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @since  2017/03/28
     * @update 2017/03/28
     */
    public function postInfo()
    {
        return $this->belongsTo('App\Models\Post', 'post_id', 'id');
    }

    /**
     * @desc
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @author Jiafang.wang
     * @since 2017/5/12 17:53
     */
    public function commentUserInfo()
    {
        return $this->belongsToMany('App\Model\User', 'comments', 'post_id', 'user_id');
    }
}
