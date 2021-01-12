<?php

namespace App\Http\Controllers;

use App\AlertHelper;

use App\StripeHelper;
use App\DiscordStore;
use App\PaymentMethod;
use App\Refund;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Auth;
use App\User;
use App\Subscription;
use App\StripeConnect;
use App\PaidOutInvoice;
use App\Ban;
use App\DiscordHelper;
use App\DiscordOAuth;

class UserController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }
 
    public static function getViewWithInvoices(string $view, int $num_of_invoices) {
        $stripe_helper = auth()->user()->getStripeHelper();
       
        if(Cache::has('user_invoices_' . auth()->user()->id)) {
            $invoices = Cache::get('user_invoices_' . auth()->user()->id);
        } else {
            StripeHelper::setApiKey();

            $invoices = \Stripe\Invoice::all([
                'limit' => $num_of_invoices,
                'customer' => auth()->user()->StripeConnect->customer_id
            ]);

            $invoices_array = $invoices->toArray()['data'];

            // sort the invoices in ASC order
            usort($invoices_array, function($a, $b) {
                return $b['created'] <=> $a['created'];
            });

            Cache::put('user_invoices_' . auth()->user()->id, $invoices_array, 60 * 10);
        }

        return view($view)->with('stripe_login_link', $stripe_helper->getLoginURL())->with('invoices', Cache::get('user_invoices_' . auth()->user()->id, array()));
    }

    public function getPayoutSlide($stripe_account_id) {

        StripeHelper::setApiKey();

        if (auth()->user()->StripeConnect->express_id != $stripe_account_id && !Auth::user()->admin) return response()->json(['success' => false, 'msg' => 'You do not own this Stripe account.']);

        #if (auth()->user()->error == "1") return response()->json(['success' => false, 'msg' => 'Please refresh the page and connect a US Stripe account.']);

        $unix_now = time();

    #####
        ## TODO: We should add payout delay to their stripe account, so if they get a dispute it adds 7 days
        /*
        $stripe_account_id = Auth::user()->stripe_account_id;
        $stripe_account = \Stripe\Account::retrieve($stripe_account_id);
        1) Get it from stripe
            $stripe_payout_delay = $stripe_account->settings->payouts->schedule->delay_days;
        2) Get it from user DB
            $stripe_payout_delay = User::where('stripe_account_id', '=' , $stripe_account_id)->value('stripe_delay_days');
        */

    #####

    ####
        ## TODO: can we get the fee percent from Stripe API?
        # so we can add days if they get disputes or lower if they are good.
        $app_fee_percent = 5;
    ####


    #### TODO: we need a faster way to get their paid invoices
        $invoices_pending = \Stripe\Invoice::all([
            'status' => 'paid',
            'created' => [
                'gte' => strtotime('-'.$stripe_payout_delay.' days', $unix_now)
            ],
        ]);

        $earnings = 0;
        $pending_invoices = array();
        foreach($invoices_pending as $invoice) {
            if ($invoice->metadata['paid_out'] != 'true' && $invoice->metadata['refunded'] != 'true') {
                try {
                    if($invoice->lines->data[0]->plan->metadata['app_fee_percent']) {
                        $app_fee_percent =  $invoice->lines->data[0]->plan->metadata['app_fee_percent'];
                    }else{
                        $app_fee_percent = 5;
                    }
                    if($invoice->lines->data[0]->plan->metadata['stripe_account_id'] == $stripe_account_id) {
                        array_push($pending_invoices, $invoice);
                        $earnings += (($invoice->amount_paid / 100) * ((100 - $app_fee_percent)/100));
                    }
                } catch(\Exception $e) {
                    \Log::error($e);
                }
            }
        }

        usort($pending_invoices, function($a, $b) {
            return $a['created'] <=> $b['created'];
        });

        return view('slide.slide-payout')->with('pending_invoices', $pending_invoices)->with('stripe_login_link', \Stripe\Account::createLoginLink($stripe_account_id)->url)->with('earnings', $earnings)->with('stripe_payout_delay', $stripe_payout_delay);
    }

    public function cancelSubscription(Request $request) {
        $sub_id = $request['sub_id'];
        $end_now = $request['end_now'];

        StripeHelper::setApiKey();

        if(!\Auth::user()->getStripeHelper()->isSubscribedToID($sub_id)) {
            return response()->json(['success' => false, 'msg' => 'This is not your subscription. Contact support']);
        }

        // Any time accessing Stripe API this snippet of code must be ran above any preceding API calls
       

        try {
            // Get subscription from stripe and cancel it.
            $sub = \Stripe\Subscription::retrieve($sub_id);

            try {
                $product = \Stripe\Product::retrieve($sub->items->data[0]->plan->product);
                if (!$product->active) throw new InvalidRequestException();
            } catch (\Exception $e) {
                if (env('APP_DEBUG')) Log::error($e);
            }

            if($end_now == "1") {
                // Must figure out how to task handler remove role now or else it will just wait till expiration date
                $sub->cancel();

                $subscription = Subscription::where('id', $sub_id)->first();
                $subscription->status = 4; 
                $subscription->save();


            } else {
                \Stripe\Subscription::update(
                    $sub_id, ['cancel_at_period_end' => true]
                );
                $subscription = Subscription::where('id', $sub_id)->first();
                $subscription->status = 2;  // cancel end period
                $subscription->save();
              
            }

        } catch (\Exception $e) {
            if (env('APP_DEBUG')) Log::error($e);
            return response()->json(['success' => false]);
        }

        return response()->json(['success' => true]);
    }

    public function undoCancelSubscription(Request $request) {
        StripeHelper::setApiKey();


        $sub_id = $request['sub_id'];
        $end_now = $request['end_now'];

        if(!\Auth::user()->getStripeHelper()->isSubscribedToID($sub_id)) {
            return response()->json(['success' => false, 'msg' => 'This is not your subscription. Contact support']);
        }

        // Any time accessing Stripe API this snippet of code must be ran above any preceding API calls


        // Get subscription from stripe and cancel it.
        $sub = \Stripe\Subscription::retrieve($sub_id);

        try {
            $product = \Stripe\Product::retrieve($sub->items->data[0]->plan->product);
            if (!$product->active) throw new InvalidRequestException();
        } catch (\Exception $e) {
            if (env('APP_DEBUG')) Log::error($e);
        }
        $subscription = Subscription::where('id', $sub_id)->first();

        if($end_now == "1" && $sub->items->data[0]->plan->active){
            $owner = User::where('id', $subscription->user_id)->first();
         
            $sub->cancel();
            $subscription->status = 4;
            $subscription->save();
            // figure out how to task handler remove role now
            return response()->json(['success' => true, 'msg' => 'Subscription cancelled immediately.']);
        }else{
            \Stripe\Subscription::update(
                $sub_id,
                ['cancel_at_period_end' => false
                ]
            );
            $subscription->status = 1;
            $subscription->save();
            return response()->json(['success' => true, 'msg' => 'Subscription un-cancelled.']);
        }

        return response()->json(['success' => false]);
    }

    public function requestSubscriptionRefund(Request $request) {
        $sub_guild_name = $request['sub_guild_name'];
        $sub_role_name = $request['sub_role_name'];
        $sub_user_id = $request['sub_user_id'];
        $sub_id = $request['sub_id'];
        $reason = $request['reason'];

        Log::info($sub_id);

        // Any time accessing Stripe API this snippet of code must be ran above any preceding API calls
        StripeHelper::setApiKey();

        try {
            
            // Get subscription from stripe and cancel it.
            $sub = \Stripe\Subscription::retrieve($sub_id);

            $subscription = Subscription::where('id', $sub_id)->first();

            if(auth()->user()->id != $subscription->user_id && auth()->user()->admin != 1) {
                return response()->json(['success' => false, 'msg' => 'This is not your subscription. Contact support']);
            }else if($subscription->status == 3){
                return response()->json(['success' => false, 'msg' => 'Refund has already been requested.']);
            }else if($subscription->status > 3){
                return response()->json(['success' => false, 'msg' => 'Subscription already refunded or canceled.']);
            }
    
            $latest_invoice = \Stripe\Invoice::retrieve($subscription->latest_invoice_id);

            $sub_refund_terms = $subscription->refund_terms;
            $sub_refund_days = $subscription->refund_days;
            $sub_refund_enabled = $subscription->refund_enabled;

            $subscription->status = 3;
            $subscription->save();
            Log::info("here0");
            try {
                        $product = \Stripe\Product::retrieve($sub->items->data[0]->plan->product);
                        if (!$product->active) throw new InvalidRequestException();
                        Log::info("here1");
                        //if(Refund::where('sub_id', $sub_id)->exists()) return response()->json(['success' => false, 'msg' => 'You have already submitted a refund request.']);
                        if(Refund::where('sub_id', $sub_id)->exists()){
                            $refund = Refund::where('sub_id', $sub_id)->first();
                            if($refund->issued == 0) return response()->json(['success' => false, 'msg' => 'Subscription set to cancel at end of term.']);
                            if($refund->issued == NULL) return response()->json(['success' => false, 'msg' => 'You have already submitted a refund request.']);
                            if($refund->issued == 1) return response()->json(['success' => false, 'msg' => 'You have been issued a refund.']);
                        }
                            //$owner = User::where('id', $product->metadata['id'])->get()[0];
                            $store = DiscordStore::where('id', $subscription->store_id)->first();
                            $owner = User::where('id', $store->user_id)->first();
                            $owner_stripe = StripeConnect::where('user_id', $store->user_id)->first();
                            $user = User::where('id', $subscription->user_id)->first();
                            $sub_stripe = StripeConnect::where('user_id', $subscription->user_id)->first();
                            
                            if($sub_refund_terms != 1){
                                //add Notification::create($owner->id, 'warning', 'Subscription refund requested.');
                            }
                            $sub_start_date = $sub['start_date'];
                            $sub_period_end = $sub['current_period_end'];
                            $owner_id = $owner->id;
                            $sub_description = $reason;
                            $sub_plan_id = $sub['items']['data'][0]['plan']['id'];
                            $sub_amount = $sub['items']['data'][0]['plan']['amount'];
                            
                            //$sub_application_fee = $sub['application_fee_percent'];
                            $sub_application_fee = 5;
                           
                            \Stripe\Subscription::update(
                                $sub_id,
                                ['cancel_at_period_end' => true
                                ]
                            );

                            Refund::create($latest_invoice->id, $sub_id, $sub_start_date, $sub_period_end, $user->id, $owner_id,/* $sub_stripe_account_id, $sub_guild_name, $sub_role_name, $sub_guild_id, $sub_role_id, $sub_refund_enabled, $sub_refund_days, $sub_refund_terms,*/ $sub_description, $sub_plan_id, $sub_amount, $sub_application_fee);
                            try {
                            // if no questions asked we can make the decision now.
                                if ($sub_refund_terms == 1){
                                        $issued = 1;
                                        $decision = 1;
                                        $ban = 0;
                                        // Any time accessing Stripe API this snippet of code must be ran above any preceding API calls

                                        try {
                                            // Get subscription from stripe and cancel it.
                                            $sub = \Stripe\Subscription::retrieve($sub_id);
                                            
                                            try {
                                                $product = \Stripe\Product::retrieve($sub->items->data[0]->plan->product);
                                                if (!$product->active) throw new InvalidRequestException();

                                                $refund = Refund::where('sub_id', $sub_id)->first();
                                                if($refund->decision == $decision){
                                                    if($refund->issued == 0) return response()->json(['success' => false, 'msg' => 'Subscription set to cancel at end of term.']);
                                                    if($refund->issued == NULL) return response()->json(['success' => false, 'msg' => 'You have already submitted a refund response.']);
                                                }
                                                try{
                                                    $invoice = $latest_invoice;
                                                    $invoice_charge = $invoice->charge;
                                                    $invoice_app_fee = $sub_application_fee;
                                                    $invoice_paid = $invoice->paid;
                                                    $user_id = $user->id;

                                                    if($owner_stripe->id == $sub_stripe->id){
                                                        $subscription->status = 4;
                                                        $subscription->save();

                                                        $refund->decision = 1;
                                                        $refund->issued = 0;
                                                        $refund->save();

                                                        $sub->delete();

                                                        return response()->json(['success' => false, 'msg' => 'Success, funds will be paid out in Payout (you are the owner of this purchase).']);
                                                        //add Notification::create($user_id, 'success', 'Refund success.');
                                                    }else{
                                                        if ($refund->issued == NULL){ // check if no decision on issued
                                                            $refund->decision = 1;
                                                            $refund->issued = $issued;
                                                            $refund->save();
                                                            if($refund->issued = 1){ // if can issue
                                                                
                                                                
                                                                $paid_out_invoice = PaidOutInvoice::where('id', $subscription->latest_invoice_id)->first();

                                                                Log::info($paid_out_invoice);

                                                                $paid_out_bool = true;
                                                                if($paid_out_invoice == NULL){
                                                                    $paid_out_bool = false;
                                                                }
                                                                $subscription->status = 5; // refunded&do not payout
                                                                $subscription->save();
                                                                
                                                                if($paid_out_bool == true){
                                                                   // if($paid_out_invoice->reversed != 1 && $paid_out_invoice->refunded != 1 && $paid_out_invoice->transfer_id != NULL && $subscription->status != 5){
                                                                    \Stripe\Transfer::createReversal($paid_out_invoice->transfer_id);
                                                                    $paid_out_invoice->reversed = 1;
                                                                    $paid_out_invoice->save();

                                                                    \Stripe\Refund::create([
                                                                        'charge' => $invoice_charge,
                                                                        'amount' => $invoice->amount_paid,
                                                                        //'refund_application_fee' => false,
                                                                        'metadata' => [
                                                                            'reversed' => true,
                                                                            'refunded' => true
                                                                            ]
                                                                        ]);
                                                                   // }
                                                                    $paid_out_invoice->refunded = 1;
                                                                    $paid_out_invoice->save();

                                                                    \Stripe\Invoice::update(
                                                                        $subscription->latest_invoice_id,
                                                                        ['metadata' => ['reversed' => true, 'refunded' => true]]
                                                                    );
                                                                    
                                                                    //add Notification::create($owner->id, 'warning', 'Payout reversed and sent successfully.');
                                                                    //add Notification::create($user_id, 'success', 'Refund success.');
                                                                }else if($subscription->status <= 3) /*if ($paid_out_bool && $paid_out_invoice->refunded != 1)*/{
                                                               
                                                                    \Stripe\Refund::create([
                                                                    'charge' => $invoice_charge,
                                                                    'amount' => $invoice->amount_paid,
                                                                    //'refund_application_fee' => false,
                                                                    'metadata' => [
                                                                        'refunded' => true
                                                                        ]
                                                                    ]);
                                                                    \Stripe\Invoice::update(
                                                                        $subscription->latest_invoice_id,
                                                                        ['metadata' => ['reversed' => false, 'refunded' => true]]
                                                                    );

                                                                    $subscription->status = 5; // refunded&do not payout
                                                                    $subscription->save();
                                                                    //add Notification::create($owner->id, 'success', 'Refund successfully sent.');
                                                                    //add Notification::create($user_id, 'success', 'Refund success.');
                                                                }
                                                           
                                                            }
                                                            //return response()->json(['success' => false, 'msg' => 'SUCCESS!']);

                                                            // TODO: we need to cancel all upcoming invoices
                                                            // remove the subscription
                                                        
                                                        }else if ($refund->issued == 1){ // check if issued already
                                               
                                                            $refund->decision = 1;
                                                            $refund->save();
                                                            return response()->json(['success' => false, 'msg' => 'Refund already issued.']);
                                                        }else{ // check if 1 (decision made but denied)
                                                            return response()->json(['success' => false, 'msg' => 'Refund already denied.']);
                                                 
                                                            $refund->decision = 1;
                                                            $refund->save();
                                                        }
                                                    }
                                                }catch (\Exception $e){
                                                    if (env('APP_DEBUG')) Log::error($e);
                                                }
                                            } catch (\Exception $e) {
                                                if (env('APP_DEBUG')) Log::error($e);
                                            }
                                            
                                            // The subscription will be removed from the DB by the bot on expiration date.
                                        } catch (\Exception $e) {
                                            if (env('APP_DEBUG')) Log::error($e);
                                            return response()->json(['success' => false]);
                                        }
                                        //return response()->json(['success' => true, 'msg' => 'You have been refunded!']);

                                    // End refund

                                        //$refund->save();
                                    }else{
                          
                                        $subscription->status = 2; // denied and canceled
                                        $subscription->save();
                                    }
                        } catch (\Exception $e) {
                            if (env('APP_DEBUG')) Log::error($e);
                        }

            // The subscription will be removed from the DB by the bot on expiration date.
                } catch (\Exception $e) {
                    if (env('APP_DEBUG')) Log::error($e);
                    return response()->json(['success' => false]);
                }

        } catch (\Exception $e) {
            if (env('APP_DEBUG')) Log::error($e);
            Log::error($e);
            return response()->json(['success' => false]);
        }

        return response()->json(['success' => true]);
    }

    public function decisionRefundRequest(Request $request) {
        //Log::info($request);
        $sub_id = $request['sub_id'];
        $issued = $request['issued'];
        $decision = "1";
        $ban = $request['ban'];
        // Any time accessing Stripe API this snippet of code must be ran above any preceding API calls
        StripeHelper::setApiKey();
        Log::info("test00");
        try {
            Log::info("test0");
            // Get subscription from stripe and cancel it.
            $sub = \Stripe\Subscription::retrieve($sub_id);

            $subscription = Subscription::where('id', $sub_id)->first();

            $latest_invoice = \Stripe\Invoice::retrieve($subscription->latest_invoice_id);

            $sub_refund_terms = $subscription->refund_terms;
            $sub_refund_days = $subscription->refund_days;
            $sub_refund_enabled = $subscription->refund_enabled;

            $sub_application_fee = 5;
                           
            //$owner = User::where('id', $product->metadata['id'])->get()[0];
            $store = DiscordStore::where('id', $subscription->store_id)->first();
            $owner = User::where('id', $store->user_id)->first();
            $owner_stripe = StripeConnect::where('user_id', $store->user_id)->first();
            $user = User::where('id', $subscription->user_id)->first();
            $sub_stripe = StripeConnect::where('user_id', $subscription->user_id)->first();

            $discord_helper = new DiscordHelper(auth()->user());
            if(! $discord_helper->ownsGuild($store->guild_id)) {
                return response()->json(['success' => false, 'msg' => 'You are not the owner of this guild. Contact Support']);
            }

            \Stripe\Subscription::update(
                $sub_id,
                ['cancel_at_period_end' => true
                ]
            );
            $subscription->status = 2;
            $subscription->save();

            try {
                Log::info("test2");
                $product = \Stripe\Product::retrieve($sub->items->data[0]->plan->product);
                if (!$product->active) throw new InvalidRequestException();

                $refund = Refund::where('sub_id', $sub_id)->first();
                if($refund->decision == $decision) return response()->json(['success' => false, 'msg' => 'You have already submitted a refund decision.']);
                    $refund->ban = $ban;
                    $refund->save();
                    if($ban == 1){
                        try{
                            Log::info("test3");
                            $discord_id = DiscordOAuth::where('user_id', $user->id)->first()->discord_id;
                            $ban = Ban::create([
                                'user_id' => $user->id, 
                                'discord_id' => $discord_id, 
                                'type' => 1, 
                                'discord_store_id' => $store->id, 
                                'guild_id' => $store->guild_id, 
                                'until' => NULL, 
                                'active' => 1, 
                                'reason' => "Subscription Refund Ban", 
                                'issued_by' => $owner->id,
                            ]);
                        }catch (\Exception $e) {
                            if (env('APP_DEBUG')) Log::error($e);
                        }
                    }
                try{
                    Log::info("test4");
                    $invoice = $latest_invoice;
                    $invoice_charge = $invoice->charge;
                    $invoice_app_fee = $sub_application_fee;
                    $invoice_paid = $invoice->paid;
                    $user_id = $user->id;

                    if($owner_stripe->id == $sub_stripe->id){
                        Log::info("test5");
                        $subscription->status = 4; // just show canceled
                        $subscription->save();

                        $refund->decision = 1;
                        $refund->issued = 0;
                        $refund->save();

                        $sub->delete();
                        return response()->json(['success' => false, 'msg' => 'Success, funds will be paid out in Payout (you are the owner of this purchase).']);
                        //add Notification::create($user_id, 'success', 'Refund success.');
                    }else{
                        if ($refund->issued == NULL){ // check if no decision on issued
                            Log::info("test6");
                            $refund->decision = 1;
                            $refund->issued = $issued;
                            $refund->save();
                            if($issued == 1){ // if yes refund
                                
                                $paid_out_invoice = PaidOutInvoice::where('id', $subscription->latest_invoice_id)->first();

                                $paid_out_bool = true;
                                if($paid_out_invoice == NULL){
                                    $paid_out_bool = false;
                                }
                                $subscription->status = 5; // refunded&do not payout
                                $subscription->save();
                                
                                if($paid_out_bool == true){
                                    Log::info("test7");
                                   // if($paid_out_invoice->reversed != 1 && $paid_out_invoice->refunded != 1 && $paid_out_invoice->transfer_id != NULL && $subscription->status != 5){
                                    \Stripe\Transfer::createReversal($paid_out_invoice->transfer_id);
                                    $paid_out_invoice->reversed = 1;
                                    $paid_out_invoice->save();

                                    \Stripe\Refund::create([
                                        'charge' => $invoice_charge,
                                        'amount' => $invoice->amount_paid,
                                        //'refund_application_fee' => false,
                                        'metadata' => [
                                            'reversed' => true,
                                            'refunded' => true
                                            ]
                                        ]);
                                   // }
                                    $paid_out_invoice->refunded = 1;
                                    $paid_out_invoice->save();

                                    \Stripe\Invoice::update(
                                        $subscription->latest_invoice_id,
                                        ['metadata' => ['reversed' => true, 'refunded' => true]]
                                    );
                                    $sub->delete();
                                    //add Notification::create($owner->id, 'warning', 'Payout reversed and sent successfully.');
                                    //add Notification::create($user_id, 'success', 'Refund success.');
                                }else if($subscription->status != 5) /*if ($paid_out_bool && $paid_out_invoice->refunded != 1)*/{
                                    Log::info("test8");
                                    \Stripe\Refund::create([
                                    'charge' => $invoice_charge,
                                    'amount' => $invoice->amount_paid,
                                    //'refund_application_fee' => false,
                                    'metadata' => [
                                        'refunded' => true
                                        ]
                                    ]);
                                    \Stripe\Invoice::update(
                                        $subscription->latest_invoice_id,
                                        ['metadata' => ['reversed' => false, 'refunded' => true]]
                                    );
                                    //add Notification::create($owner->id, 'success', 'Refund successfully sent.');
                                    //add Notification::create($user_id, 'success', 'Refund success.');
                                    $sub->delete();
                                }
                                   
                            }else{
                                Log::info("test9");
                                $subscription->status = 4; // denied and canceled
                                $subscription->save();
                            }
                            //return response()->json(['success' => false, 'msg' => 'SUCCESS!']);

                            // TODO: we need to cancel all upcoming invoices
                            // remove the subscription
                           
                        }else if ($refund->issued == 1){ // check if issued already
                            Log::info("test10");
                            $refund->decision = 1;
                            $refund->save();
                            return response()->json(['success' => false, 'msg' => 'Refund already issued.']);
                        }else{ // check if 1 (decision made but denied)
                            return response()->json(['success' => false, 'msg' => 'Refund already denied.']);
                            Log::info("test11");
                            $refund->decision = 1;
                            $refund->save();
                        }
                    }
                }catch (\Exception $e){
                    Log::info("test12");
                    if (env('APP_DEBUG')) Log::error($e);
                }
            } catch (\Exception $e) {
                Log::info("test13");
                if (env('APP_DEBUG')) Log::error($e);
            }

            //$sub->cancel();
            // The subscription will be removed from the DB by the bot on expiration date.
        } catch (\Exception $e) {
            Log::info("test14");
            if (env('APP_DEBUG')) Log::error($e);
            return response()->json(['success' => false]);
        }

        return response()->json(['success' => true]);
    }

    public function getServersAndStores(){
        $discord_o_auth = DiscordOAuth::where('user_id', auth()->user()->id)->first();
        $discord_helper = auth()->user()->getDiscordHelper();

        if($discord_helper->getGuilds()) {
            $serversstores = array(); 
            foreach($discord_helper->getGuilds() as $server) {
                $shop = DiscordStore::where('guild_id', $server['id'])->first();

                if($shop) {
                    $serverstore = ["" . $server['id'], $server['name'], $server['icon'], $shop->url, $shop->live, $server['owner'] ? "Owner" : "Member", $discord_helper->guildHasBot($server['id'])]; // server id, name, icon, shop, live, joined
                } else { 
                    $serverstore = ["" . $server['id'], $server['name'], $server['icon'], false, false, $server['owner'] ? "Owner" : "Member", $discord_helper->guildHasBot($server['id'])]; 
                }
                array_push($serversstores, $serverstore);
            }
            return $serversstores;
            
        }
    }

    public function impersonate($id)
    {       
        if(Auth::user()->admin == 1){
            Auth::logout(); // for end current session
            Auth::loginUsingId($id);

            return redirect()->to('/dashboard');
        }else{
            return redirect()->to('/');
        }
    }

}
