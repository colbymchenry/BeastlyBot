<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ban extends Model
{
    protected $fillable = ['user_id', 'discord_id', 'type', 'discord_store_id', 'guild_id', 'until', 'active', 'reason', 'issued_by'];
    
    protected $casts = [
        'until' => 'datetime'
    ];
}
