<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    protected $table = 'sms';
    public $fillable = array(
        'username','sms_type',  'code', 'type', 'created_at', 'updated_at'
    );
}
