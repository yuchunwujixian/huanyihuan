<?php
/**
 * 职位管理控制器
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Baum\Node;

class JobCategory extends Node
{

    protected $table ='job_categories';

    /**
     * 该分类下的职位
     * @since date
     * @author Jiafang.Wang
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jobs()
    {
        return $this->hasMany('App\Models\Job', 'job_category_id', 'id');
    }
}
