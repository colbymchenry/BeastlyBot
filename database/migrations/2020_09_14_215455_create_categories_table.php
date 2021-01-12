<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('icon')->nullable();
            $table->string('priority')->nullable()->default('medium');
            $table->integer('assign')->nullable()->default(1); // 1 all, 2 partners, 3 internal, 4 admins only
            $table->string('email')->nullable()->default('team@beastly.app');
            $table->integer('setting')->nullable()->default(1); // 1 show all, 2 show partners, 0 disabled
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
        Schema::dropIfExists('categories');
    }
}
