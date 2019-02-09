<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Outsource extends Model
{
    public $fillable = array(
        'title', 'contact', 'tel_type_id', 'telephone', 'outsource_id', 'precondition_id', 'cooperation_id',
        'description', 'needs', 'content', 'status', 'created_at', 'updated_at', 'user_id', 'company_id',
        'province_code'
    );
    /**
     * @name userInfo
     * @desc 对应的发布者信息
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @since  2017/3/30 9:24
     * @update 2017/3/30 9:24
     */
    public function userInfo()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    /**
     * @name companyInfo
     * @desc 对应的公司信息
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @since  2017/3/30 9:24
     * @update 2017/3/30 9:24
     */
    public function companyInfo()
    {
        return $this->belongsTo('App\Models\Company', 'company_id', 'id');
    }
}
