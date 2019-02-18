<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipNews extends Model
{
    protected $fillable = [
        'title',
        'url',
        'status',
        'sort',
    ];
}
