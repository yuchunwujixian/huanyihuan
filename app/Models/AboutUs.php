<?php
/**
 * 关于我们
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    public $table='about_us';
    public $fillable = [
        'description', 'meta_keywords', 'meta_description', 'policy','logo',
    ];
    protected $appends = ['third_logo'];

    //图片地址
    public function getThirdLogoAttribute()
    {
        return env('THIRD_HOST', '').'/storage/public/'.$this->logo;
    }
}
