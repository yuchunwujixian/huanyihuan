<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopicGoods extends Model
{
    protected $table = 'topic_goods';
    protected $fillable = [
        'goods_id',
        'topic_id',
    ];
}
