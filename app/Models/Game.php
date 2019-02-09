<?php
/**
 * 游戏控制器
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    /**
     * @name companyInfo
     * @desc   所属公司
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @since  2017/03/22
     * @update 2017/03/22
     */
    public function companyInfo()
    {
        return $this->belongsTo('App\Models\Company', 'company_id', 'id');
    }


    /**
     * @name areaGameInfo
     * @desc   合作地区
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @since  2017/03/22
     * @update 2017/03/22
     */
    public function gameAreaInfo()
    {
        return $this->hasMany('App\Models\GameArea', 'game_id', 'id');
    }


    /**
     * @name areaGameInfo
     * @desc   游戏截图
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @since  2017/03/22
     * @update 2017/03/22
     */
    public function gamePhotoInfo()
    {
        return $this->hasMany('App\Models\GamePhoto', 'game_id', 'id');
    }


    /**
     * @name connentPeople
     * @desc  游戏联系人
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @since  2017/03/22
     * @update 2017/03/22
     */
    public function gameContact()
    {
        return $this->hasMany('App\Models\GameContact', 'game_id', 'id');
    }

}
