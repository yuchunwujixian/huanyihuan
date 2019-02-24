<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = 'topic_modules';
    protected $fillable = [
        'title',
        'status',
        'sort',
    ];

    public function goods()
    {
        return $this->belongsToMany('App\Models\Goods', 'topic_goods', 'topic_id', 'goods_id');
    }
}
