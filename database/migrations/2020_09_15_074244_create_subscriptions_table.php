<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->string('id')->unique();
            
            $table->bigInteger('user_id');
            $table->bigInteger('partner_id');
            $table->bigInteger('stripe_connect_id');

            // Invoices
            $table->integer('status')->default(1); // maybe 1 good, 2 overdue, 3 cancelled, 4 disputed
            $table->string('latest_invoice_id')->nullable();
            $table->string('latest_invoice_paid_at')->nullable(); // + 15 days and CRON goes

            // Payouts
            $table->double('latest_invoice_amount')->default(0); // can reset to 0 when paid out, keep ticking up if partner account facks up
            $table->string('latest_paid_out_invoice_id')->nullable(); // for double checking latest paid out (not necessary)
            $table->string('disputed_invoice_id')->nullable(); // acts as bool to not payout until/if resolved

            // Partner/Store/Product Info
            $table->integer('connection_type')->default(1); // 1 discord, 2 twitter etc
            $table->integer('connection_id'); // links to ex) discord_o_auths ID
            $table->bigInteger('store_id'); // links to ex) discord_store ID
            $table->string('product_id'); // links to ex) product_roles ID
            $table->integer('level')->default(1); // level of payout time of order

            // Store Policy at time Purchase
            $table->integer('refund_enabled')->default(1); // 0 no, 1 yes
            $table->integer('refund_days')->default(7);
            $table->integer('refund_terms')->default(1); // 1 or 2

            $table->json('metadata');

            $table->integer('visible')->default(1); // can use to hide on site
            $table->string('current_period_end'); // + 15 days and CRON goes

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
        Schema::dropIfExists('subscriptions');
    }
}
