<?php
/**
 * 职位管理控制器
 */
namespace App\Models;

use Baum\Node;

class GoodsCategory extends Node
{

    protected $table ='goods_categories';

    /**
     * 该分类下的职位
     * @since date
     * @author Jiafang.Wang
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jobs()
    {
        return $this->hasMany('App\Models\Job', 'category_id', 'id');
    }
}
