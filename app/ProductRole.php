<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductRole extends Model
{
    protected $fillable = ['discord_store_id', 'role_id'];

    public function store()
    {
        return $this->belongsTo(DiscordStore::class);
    }
}
