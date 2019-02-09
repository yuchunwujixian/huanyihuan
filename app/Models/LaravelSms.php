<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaravelSms extends Model
{
    public $fillable = array(
        'mobile', 'code', 'status', 'created_at', 'updated_at'
    );
}
