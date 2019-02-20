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
}
