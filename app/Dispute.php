<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dispute extends Model
{
    public $incrementing = false;
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $casts = [
        'metadata' => 'array',
    ];
}
