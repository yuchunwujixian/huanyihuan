<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * @name productPhotos
     * @desc  获得产品需求图片
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @since  2017/05/07
     * @update 2017/05/07
     */
    public function productPhotos()
    {
        return $this->hasMany('App\Models\ProductPhoto', 'product_id', 'id');
    }

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

    /**
     * @name productPersons
     * @desc 产品联系人
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @since  2017/05/12
     * @update 2017/05/12
     */
    public function productPersons()
    {
        return $this->hasMany('App\Models\ProductPerson', 'product_id', 'id');
    }
}
