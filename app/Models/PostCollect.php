<?php
/**
 * -----------------------------------------
 * Desc: 帖子-收藏表
 * User: Jiafang.Wang
 * Date: 2017/3/30
 * Time: 9:58
 * File: PostCollect.php
 * Project: www
 * -----------------------------------------
 */


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class PostCollect extends Model
{
    public function postInfo()
    {
        return $this->belongsToMany('App\Models\Post', 'post', 'post_id', 'id');
    }
}