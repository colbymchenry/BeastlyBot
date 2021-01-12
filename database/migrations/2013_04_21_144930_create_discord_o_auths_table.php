<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscordOAuthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discord_o_auths', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->integer('user_id');
            $table->bigInteger('discord_id');
            $table->string('access_token');
            $table->string('refresh_token');
            $table->bigInteger('token_expiration');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discord_o_auths');
    }
}
