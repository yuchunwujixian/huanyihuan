<?php
/**
 * -----------------------------------------
 * Desc: 职位模型
 * User: Jiafang.Wang
 * Date: 2017/3/20
 * Time: 15:25
 * File: Job.php
 * Project: DoctorVisit
 * -----------------------------------------
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Goods extends Model
{
    use SoftDeletes;
    protected $table = 'goods';
    //用户
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    //分类
    public function category()
    {
        return $this->belongsTo('App\Models\GoodsCategory', 'user_id', 'id');
    }
    //缩略图
    public function imgs()
    {
        return $this->hasMany('App\Models\GoodsImg', 'goods_id', 'id');
    }
    //专题
    public function topics()
    {
        return $this->belongsToMany('App\Models\Topic', 'topic_goods', 'goods_id', 'topic_id');
    }

}
