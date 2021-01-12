<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StripeConnect extends Model
{

    // public $primaryKey = 'user_id';
    // protected $incrementing = false;

    protected $fillable = ['user_id', 'customer_id', 'express_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
