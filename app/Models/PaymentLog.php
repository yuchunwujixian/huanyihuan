<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    public $fillable = array(
        'user_id', 'account', 'payment', 'status'
    );

    public function userInfo()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

}
