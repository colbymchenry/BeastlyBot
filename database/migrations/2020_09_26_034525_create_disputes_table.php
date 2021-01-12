<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisputesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disputes', function (Blueprint $table) {

            $table->string('id')->unique(); // inv id
            $table->integer('user_id');
            $table->integer('type');
            $table->integer('type_id');
            $table->integer('status');
            $table->string('fee_invoice')->nullable();
            $table->integer('fee_paid')->nullable();
            $table->json('metadata')->nullable();
            $table->longText('notes')->nullable();
            
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
        Schema::dropIfExists('disputes');
    }
}
