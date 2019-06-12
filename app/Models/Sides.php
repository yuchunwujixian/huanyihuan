<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sides extends Model
{
    protected $table = 'index_sides';
    protected $fillable = [
        'title',
        'url',
        'img_url',
        'status',
        'sort',
        'type',
        'p_id',
    ];
    protected $appends = ['third_img_url'];

    //图片地址
    public function getThirdImgUrlAttribute()
    {
        return env('THIRD_HOST', '').'/storage/'.$this->img_url;
    }

    //获得分类下幻灯片
    public static function getData($type)
    {
        $data = [];
        switch ($type){
            case 1://获取专题类型
                $data = Topic::where('status', 1)->orderBy('sort', 'asc')->get(['id', 'title as name']);
                break;
            //TODO::可继续添加
        }
        return $data;
    }
}
