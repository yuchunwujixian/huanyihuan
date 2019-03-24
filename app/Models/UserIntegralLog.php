<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserIntegralLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'type',
        'change_value',
        'change_before',
        'note',
        'created_at',
    ];

    public function add($data){
        return $this->fill($data)->save();
    }
}
