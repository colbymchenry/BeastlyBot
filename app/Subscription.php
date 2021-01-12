<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    public $incrementing = false;
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $casts = [
        'metadata' => 'array',
        'latest_invoice_paid_at'=>'datetime:Y-m-d H:i:s',
        'current_period_end'=>'datetime:Y-m-d'
    ];

}
