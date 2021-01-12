<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaidOutInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paid_out_invoices', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string('sub_id');
	        $table->double('amount');
	        $table->integer('connection_type');
	        $table->integer('connection_id');
            $table->string('store_id');
            $table->string('transfer_id')->nullable();
            $table->integer('refunded')->nullable();
            $table->integer('reversed')->nullable();
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
        Schema::dropIfExists('paid_out_invoices');
    }
}
