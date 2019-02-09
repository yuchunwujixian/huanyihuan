<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Integral;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'mobile', 'company_id', 'department', 'manage_area', 'manage_matters', 'position',
        'description', 'integral', 'qq', 'weixin', 'telphone', 'level'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @desc 公司信息
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * @author Jiafang.wang
     * @since 2017/5/12 17:06
     */
    public function companyInfo()
    {
        return $this->belongsTo('App\Models\Company', 'company_id', 'id');
    }

    /**
     * @desc 收藏的帖子
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @author Jiafang.wang
     * @since 2017/5/12 17:06
     */
    public function collectPostsInfo()
    {
        return $this->belongsToMany('App\Models\Post', 'post_collects', 'user_id', 'post_id');
    }

    /**
     * @desc 评论过的帖子
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @author Jiafang.wang
     * @since 2017/5/12 17:10
     */
    public function commentPostsInfo()
    {
        return $this->belongsToMany('App\Models\Post', 'comments', 'user_id', 'post_id');
    }

    public function messages($user_id, $type = '')
    {
        if ($type == "view_feedback") {
            return Integral::where('view_feedback', 0)
                ->where('receive_user_id', $user_id)
                ->count();
        }
        if ($type == "view_issue") {
            return Integral::where('view_issue', 0)
                ->where('user_id', $user_id)->count();
        }
        return Integral::where('view_feedback', 0)
            ->where('receive_user_id', $user_id)
            ->count() + Integral::where('view_issue', 0)
            ->where('user_id', $user_id)->count();
    }
}
