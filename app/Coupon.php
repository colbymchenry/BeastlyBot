<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public $incrementing = false;
    protected $fillable = ['id', 'owner_id'];
}
