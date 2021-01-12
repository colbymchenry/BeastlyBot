<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bans', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('discord_id')->nullable();
            $table->integer('type')->default(1); // 0 user from site, 1 user from view store, 2 user from create store
            $table->integer('discord_store_id')->nullable();
            $table->string('guild_id')->nullable();
            $table->string('until')->nullable();
            $table->string('active')->default(1);
            $table->longText('reason')->nullable();
            $table->integer('issued_by')->default(0);
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
        Schema::dropIfExists('bans');
    }


}
