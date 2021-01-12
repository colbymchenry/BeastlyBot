<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    protected $fillable = [
        'type', 'type_id', 'data'
    ];

    protected $casts = [
        'data' => 'array'
    ];
}
