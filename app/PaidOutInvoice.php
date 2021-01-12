<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaidOutInvoice extends Model
{
    protected $fillable = ['sub_id'];
    public $incrementing = true;
    public $primaryKey = 'id';
}
