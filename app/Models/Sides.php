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
