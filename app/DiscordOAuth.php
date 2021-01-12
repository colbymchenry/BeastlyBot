<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscordOAuth extends Model
{

    // public $primaryKey = 'user_id';
    // protected $incrementing = false;

    protected $fillable = ['user_id', 'discord_id', 'access_token', 'refresh_token', 'token_expiration'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
