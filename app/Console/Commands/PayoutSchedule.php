<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\User;
use App\Subscription;
use App\StripeConnect;
use App\StripeHelper;
use App\DiscordStore;
use App\PaidOutInvoice;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PayoutSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payout:schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find and issue payouts via Subscription DB';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $subscriptions_eligable = Subscription::whereRaw('latest_invoice_id != latest_paid_out_invoice_id')->where('disputed_invoice_id', NULL)->where('latest_invoice_amount', '>', 0)->where('status', '<=', 4)->where('latest_invoice_paid_at', '<=', Carbon::now()->subDays(1))->orWhereNull('latest_paid_out_invoice_id')->where('disputed_invoice_id', NULL)->where('latest_invoice_amount', '>', 0)->where('latest_invoice_paid_at', '<=', Carbon::now()->subDays(1))->where('status', '<=', 4)->get();


        foreach ($subscriptions_eligable as $sub_eligable) {

            $stripe_connect = StripeConnect::find($sub_eligable->stripe_connect_id);

            StripeHelper::setApiKey();
            try {
                // Retrieve expressAccount
                $expressAccount = \Stripe\Account::retrieve(
                    $stripe_connect->express_id,
                    []
                );
                // We check if their Stripe account is from the US
                if($expressAccount->country == 'US'){
                    // We create the transfer for the payout amount
                    try {
                        
                        $app_fee = 0.05 * $sub_eligable->level;
                        Log::info($sub_eligable->latest_invoice_amount * (1 - $app_fee));
                        // Send payment
                        try{

                            try{
                                $transfer = \Stripe\Transfer::create([
                                    'amount' => $sub_eligable->latest_invoice_amount * (1 - $app_fee),
                                    'currency' => 'usd',
                                    'destination' => $stripe_connect->express_id,
                                    'transfer_group' => $sub_eligable->id,
                                ]);
                            }catch (ApiErrorException $e) {
                                if (env('APP_DEBUG')) Log::error($e);
                                // Failed to Transfer
                            }
                        // if pass continue

                        // Update DB 
                        $sub_eligable->latest_paid_out_invoice_id = $sub_eligable->latest_invoice_id;
                        $sub_eligable->save();

                        // Add payout entry
                        Log::info($sub_eligable->latest_invoice_id);
                        $paidOutInvoice = new PaidOutInvoice();
                        $paidOutInvoice->id = $sub_eligable->latest_invoice_id;
                        $paidOutInvoice->sub_id = $sub_eligable->id;
                        $paidOutInvoice->amount = $sub_eligable->latest_invoice_amount * (1 - $app_fee);
                        $paidOutInvoice->connection_type = $sub_eligable->connection_type;
                        $paidOutInvoice->connection_id = $sub_eligable->connection_id;
                        $paidOutInvoice->store_id = $sub_eligable->store_id;
                        $paidOutInvoice->transfer_id = $transfer->id;
                        $paidOutInvoice->save();

                        }catch (ApiErrorException $e) {
                            if (env('APP_DEBUG')) Log::error($e);
                            // Failed to Transfer
                        }
                          
                        


                    }catch (ApiErrorException $e) {
                        if (env('APP_DEBUG')) Log::error($e);
                        // Failed to Transfer
                    }

                }
            }catch (ApiErrorException $e) {
                if (env('APP_DEBUG')) Log::error($e);
                // Failed to get Stripe Express
            }


        }

        return 0;
    }
}