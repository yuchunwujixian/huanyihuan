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
        'description', 'meta_keywords', 'meta_description', 'policy'
    ];
}
