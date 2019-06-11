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
        'mobile', 'nickname', 'name', 'email', 'password', 'description', 'level', 'avatar', 'status', 'integral'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $appends = ['third_avatar'];

    //图片地址
    public function getThirdAvatarAttribute()
    {
        return env('THIRD_HOST', '').'/storage/public/'.$this->avatar;
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
        return 0;
//        if ($type == "view_feedback") {
//            return Integral::where('view_feedback', 0)
//                ->where('receive_user_id', $user_id)
//                ->count();
//        }
//        if ($type == "view_issue") {
//            return Integral::where('view_issue', 0)
//                ->where('user_id', $user_id)->count();
//        }
//        return Integral::where('view_feedback', 0)
//            ->where('receive_user_id', $user_id)
//            ->count() + Integral::where('view_issue', 0)
//            ->where('user_id', $user_id)->count();
    }

    public static function giveIntegral($user_id = 0, $type = 1, $num = 1, $note = '')
    {
        if (!$user_id || !$num || $num == 0){
            return false;
        }
        $user = self::getUserInfo(['id' => $user_id]);
        if (!$user){
            return false;
        }
        //判断是否领取
        $config_int = config('config_base.integral_type');
        if (empty($config_int[$type])){
            return false;
        }
        $config_int = $config_int[$type];
        switch ($config_int['frequency_type']){
            case 'one'://一次性
                $map = [
                    'user_id' => $user_id,
                    'type' => $type,
                ];
            $log = UserIntegralLog::where($map)->first();
            if (!empty($log)){
                return false;
            }
            break;
            case 'day'://相隔天数
                $map = [
                    'user_id' => $user_id,
                    'type' => $type,
                ];
                $log = UserIntegralLog::where($map)->orderBy('id', 'desc')->first();
                if (!empty($log) && time() - strtotime($log->created_at) < $config_int['frequency_num'] * 86400){
                    return false;
                }
                break;
        }
        if ($num > 0){
            $res = $user->increment('integral', $num);
        }else{
            $res = $user->decrement('integral', -$num);
        }
        if (!$res){
            return false;
        }
        //加入日志
        $add = [
            'user_id' => $user_id,
            'type' => $type,
            'change_value' => $num,
            'change_after' => $user->integral,
            'note' => $note,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $res = (new UserIntegralLog)->add($add);
        if (!$res){
            return false;
        }
        return true;
    }

    public static function getUserInfo($where, $fields = '*', $is_one = true)
    {
        unset($where['password']);
        if (empty($where)){
            return false;
        }
        if ($is_one){
            return self::where($where)->select($fields)->first();
        }else{
            return self::where($where)->select($fields)->get();
        }
    }
}
