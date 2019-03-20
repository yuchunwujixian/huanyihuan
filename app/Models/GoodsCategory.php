<?php
/**
 * 职位管理控制器
 */
namespace App\Models;

use Baum\Node;

class GoodsCategory extends Node
{
    protected $table ='goods_categories';

    public function goods()
    {
        return $this->hasMany('App\Models\Goods', 'category_id', 'id');
    }
    public function childs()
    {
        return $this->hasMany('App\Models\GoodsCategory', 'parent_id', 'id');
    }
    public function parent()
    {
        return $this->belongsTo('App\Models\GoodsCategory', 'parent_id', 'id');
    }
}
