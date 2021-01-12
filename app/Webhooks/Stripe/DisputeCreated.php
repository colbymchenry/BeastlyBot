<?php

namespace App\Webhooks\Stripe;

use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\WebhookClient\Models\WebhookCall;
use \App\StripeConnect;
use \App\DiscordOAuth;
use \App\NewSubscription;

use \App\ScheduledInvoicePayout;
use \App\DiscordStore;
use \App\Subscription;
use \App\Stat;
use \App\Dispute;
use \App\PaidOutInvoice;
use App\Ban;
use RestCord\DiscordClient;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use \App\StripeHelper;

class DisputeCreated implements ShouldQueue
{
    public function handle(WebhookCall $webhookCall)
    {
        $stripe = StripeHelper::getStripeClient();

        $object = $webhookCall->payload['data']['object'];

        $charge_id = $webhookCall->payload['data']['object']['charge'];
      
        $charge = $stripe->charges->retrieve(
            $charge_id,
            []
        );

        $invoice_id = $charge['invoice'];

        $invoice = $stripe->invoices->retrieve(
            $invoice_id,
            []
        );

        $invoice_id = $invoice['id']; // "in_
        $invoice_total = $invoice['amount']; // 2500
        $invoice_customer = $invoice['customer']; // "cus_
        $invoice_customer_email = $invoice['customer_email']; // ""
        $invoice_pdf = $invoice['invoice_pdf']; // "http

        $invoice_product_description = $invoice['lines']['data'][0]['description']; // "1 X Live 
        $invoice_product_subscription = $invoice['lines']['data'][0]['subscription']; // "sub_

        // Cancel subscription
        $sub = $stripe->subscriptions->retrieve(
            $invoice_product_subscription,
            [],
        );
       // $sub->cancel();
       
        $stripe->subscriptions->update(
            $invoice_product_subscription,
            ['cancel_at_period_end' => true]
          );

        $subscription = Subscription::where('id', $invoice_product_subscription)->first();
        $subscription->status = 6;  // disputed, canceled and reversed
        $subscription->save();

        // Check and reverse paid out
        $paid_out_invoice = PaidOutInvoice::where('id', $invoice_id)->first();

        $paid_out_bool = true;
        if($paid_out_invoice == NULL){
            $paid_out_bool = false;
        }
        
        if($paid_out_bool == true){
           // if($paid_out_invoice->reversed != 1 && $paid_out_invoice->refunded != 1 && $paid_out_invoice->transfer_id != NULL && $subscription->status != 5){
            \Stripe\Transfer::createReversal($paid_out_invoice->transfer_id);
            $paid_out_invoice->reversed = 1;
            $paid_out_invoice->save();

            \Stripe\Refund::create([
                'charge' => $charge_id,
                'amount' => $invoice_total,
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
                $invoice_id,
                ['metadata' => ['reversed' => true, 'refunded' => true]]
            );
        }

        // Setup refund response
        $invoice_price_type = $invoice['lines']['data'][0]['price']['type']; // "recurring"
        $invoice_recurring_interval = $invoice['lines']['data'][0]['price']['recurring']['interval']; // "monthly"
        $invoice_recurring_interval_count = $invoice['lines']['data'][0]['price']['recurring']['interval_count']; // 1

        $charge_email = $charge['billing_details']['email'];
        $charge_name = $charge['billing_details']['name'];
        $charge_postal_code = $charge['billing_details']['address']['postal_code'];
        $charge_country = $charge['billing_details']['address']['country'];

        // use later to block this card
        $charge_network = $charge['payment_method_details']['card']['network'];
        $charge_exp_month = $charge['payment_method_details']['card']['exp_month'];
        $charge_exp_year = $charge['payment_method_details']['card']['exp_year'];
        $charge_last4 = $charge['payment_method_details']['card']['last4'];

        $subscription = Subscription::where('id', $invoice_product_subscription)->first();
        $shop = DiscordStore::where('id', $subscription->store_id)->first();

        if($shop->level < 10){
            $shop->level = $shop->level + 1;
            $shop->save();
        }
        $stats = Stat::where('type', 1)->where('type_id', $shop->id)->first();
        $disputes_active = $stats->data['disputes']['active'];
        $disputes_total = $stats->data['disputes']['total'];

        $stats_data = $stats->data;
        $stats_data['disputes'] = ['active' => $disputes_active + 1, 'total' => $disputes_total + 1];
        $stats->data = $stats_data;
        $stats->save();

        // Start refund response
        if($subscription->refund_enabled == 1 && $subscription->refund_days > 0){
            if($subscruption->terms == 2){
                $subscription_refund_terms = "Refund by Shop Owner choice within " . $subscription->refund_days . " days.";
            }else{
                $subscription_refund_terms = "Refund no questions asked within " . $subscription->refund_days . " days.";
            }
        }else{
            $subscription_refund_terms = "Refunds not accepted. Purchase with trust in Shop Owner.";
        }

        $discord_o_auth = DiscordOAuth::where('user_id', $subscription->user_id)->first();
        
        $dispute_id = $webhookCall->payload['data']['object']['id']; // "dp_
        
        $dispute = new Dispute();
        $dispute->id = $invoice_id;
        $dispute->user_id = $subscription->user_id;
        $dispute->type = 1;
        $dispute->type_id = $subscription->store_id;
        $dispute->status = 1;
        $dispute->fee_invoice = "NA";
        $dispute->fee_paid = 1;
        $dispute->save();

        //winning_evidence We have happily contacted the payer to understand and resolve the problem.
        // Finally update Dispute and send response to bank
        $stripe->disputes->update(
            $dispute_id,
            ['metadata' => ['evidence_submitted' => '1'],
            'evidence' => ['uncategorized_text'=>'We have happily contacted the payer to understand and resolve the problem.', /*'customer_signature' => $discord_o_auth->access_token, */'access_activity_log' => 'Updated at: ' . $discord_o_auth->updated_at . ' Created at: ' . $discord_o_auth->created_at . ' Discord ID: ' . $discord_o_auth->discord_id . 'Access by: Discord User Login', 'billing_address' => $charge_name . ' ' . $charge_postal_code . ' ' . $charge_country, 'customer_name' => $charge_name, 'customer_email_address' => $charge_email, 'product_description' => $invoice_product_description . ' on Discord Server ' . $shop->url . ', (' . $shop->description . ')', /*'receipt' => $invoice_pdf, */'refund_policy_disclosure' => 'Shop Purchase Terms: ' . $subscription_refund_terms, /*'refund_policy' => 'Company Terms: https://beastlybot.com/terms',*//* 'cancellation_policy' => 'Cancel anytime at https://beastlybot.com/account/subscriptions',*/ 'refund_refusal_explanation' => 'Refunds are allowed, explained and supported easily within purchase website.', 'service_date' => $subscription->updated_at, 'cancellation_rebuttal' => 'Subscription could be canceled any time and could be fully refunded within '. $subscription->refund_days . ' days as noted on checkout. Subscription now canceled due to dispute.'],
            'submit' => true,
            ]
        );

        // Create invoice/invoice item for $15 to stripe connect   

        
        // Create Ban for User

        $ban = Ban::create([
            'user_id' =>  $subscription->user_id, 
            'discord_id' => $discord_o_auth->discord_id, 
            'type' => 1, 
            'discord_store_id' => $shop->id, 
            'guild_id' => $shop->guild_id, 
            'until' => NULL, 
            'active' => 1, 
            'reason' => "Subscription Dispute Ban", 
            'issued_by' => 0,
        ]);
        
    }

    // {
    //     "created": 1326853478,
    //     "livemode": false,
    //     "id": "evt_00000000000000",
    //     "type": "charge.dispute.created",
    //     "object": "event",
    //     "request": null,
    //     "pending_webhooks": 1,
    //     "api_version": "2019-08-14",
    //     "data": {
    //       "object": {
    //         "id": "dp_00000000000000",
    //         "object": "dispute",
    //         "amount": 1000,
    //         "balance_transactions": [
    //         ],
    //         "charge": "ch_00000000000000",
    //         "created": 1600648573,
    //         "currency": "usd",
    //         "evidence": {
    //           "access_activity_log": null,
    //           "billing_address": n
    //           "cancellation_policy": null,
    //           "cancellation_policy_disclosure": null,
    //           "cancellation_rebuttal": null,
    //           "customer_communication": null,
    //           "customer_email_address": null,
    //           "customer_name": null,
    //           "customer_purchase_ip": null,
    //           "customer_signature": null,
    //           "duplicate_charge_documentation": null,
    //           "duplicate_charge_explanation": null,
    //           "duplicate_charge_id": null,
    //           "product_description": null,
    //           "receipt": null,
    //           "refund_policy": null,
    //           "refund_policy_disclosure": null,
    //           "refund_refusal_explanation": null,
    //           "service_date": null,
    //           "service_documentation": null,
    //           "shipping_address": null,
    //           "shipping_carrier": null,
    //           "shipping_date": null,
    //           "shipping_documentation": null,
    //           "shipping_tracking_number": null,
    //           "uncategorized_file": null,
    //           "uncategorized_text": null
    //         },
    //         "evidence_details": {
    //           "due_by": 1602374399,
    //           "has_evidence": false,
    //           "past_due": false,
    //           "submission_count": 0
    //         },
    //         "is_charge_refundable": true,
    //         "livemode": false,
    //         "metadata": {
    //         },
    //         "payment_intent": "pi_00000000000000",
    //         "reason": "general",
    //         "status": "needs_response"
    //       }
    //     }
    //   }

   
}