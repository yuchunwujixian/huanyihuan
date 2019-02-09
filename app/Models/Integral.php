<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Integral extends Model
{
    /**
     * @name userInfo
     * @desc  发布者信息
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @since  2017/05/19
     * @update 2017/05/19
     */
    public function userInfo()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    /**
     * @name receiveUserInfo
     * @desc  接收者信息
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @since  2017/5/19 13:15
     * @update 2017/5/19 13:15
     */
    public function receiveUserInfo()
    {
        return $this->belongsTo('App\Models\User', 'receive_user_id', 'id');
    }
}
