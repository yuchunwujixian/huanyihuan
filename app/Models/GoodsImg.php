<?php
/**
 * 游戏图片
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsImg extends Model
{
    protected $appends = ['third_img_url'];

    //图片地址
    public function getThirdImgUrlAttribute()
    {
        return env('THIRD_HOST', '').'/storage/public/'.$this->img_url;
    }
}
