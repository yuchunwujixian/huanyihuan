<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Release extends Model
{
    /**
     * @name userInfo
     * @desc  获得用户姓名
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @since  2017/03/27
     * @update 2017/03/27
     */
    public function userInfo()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    
}
