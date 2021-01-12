<?php

namespace App\Listeners;

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
use RestCord\DiscordClient;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use \App\StripeHelper;

class DisputeClosed implements ShouldQueue
{
    public function handle(WebhookCall $webhookCall)
    {

       $stripe = StripeHelper::getStripeClient();

        $object = $webhookCall->payload['data']['object'];

        $dispute_status = $webhookCall->payload['data']['object']['status'];

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

        $invoice_product_description = $invoice['lines']['data'][0]['description']; // "1 X Live 
        $invoice_product_subscription = $invoice['lines']['data'][0]['subscription']; // "sub_

        // Check and reverse paid out
        $paid_out_invoice = PaidOutInvoice::where('id', $invoice_id)->first();

        $paid_out_bool = true;
        if($paid_out_invoice == NULL){
            $paid_out_bool = false;
        }

        $subscription = Subscription::where('id', $invoice_product_subscription)->first();
        $shop = DiscordStore::where('id', $subscription->store_id)->first();

        $stats = Stat::where('type', 1)->where('type_id', $shop->id)->first();
        $disputes_active = $stats->data['disputes']['active'];
        $disputes_total = $stats->data['disputes']['total'];

        $dispute = Dispute::where('id', $invoice_id)->first();

        if($dispute_status == "won" && $subscription->status != 5){

            /*if($paid_out_bool == true){
                if($paid_out_invoice->refunded != 1){
                    // Was paid out before then reversed and not refunded, so we can send again
  

                }
            }*/

            // Update Subscription Status
            $subscription->status = 7;
            $subscription->save();

            // Update Dispute Status
            $dispute->status = 7;
            $dispute->save();

            // Update Stats

            $stats_data = $stats->data;
            $stats_data['disputes'] = ['active' => $disputes_active - 1, 'total' => $disputes_total];
            $stats->data = $stats_data;
            $stats->save();

            try{
                if($shop->level > 3){
                    $shop->level = $shop->level - 1;
                    $shop->save();
                }
            }catch (ApiErrorException $e) {
                if (env('APP_DEBUG')) Log::error($e);
                // Failed to Transfer
            }
            

        }else{
           

            // Update Subscription Status
            $subscription->status = 8;
            $subscription->save();

            // Update Dispute Status
            $dispute->status = 8;
            $dispute->save();


        }

        $sub = $stripe->subscriptions->retrieve(
            $invoice_product_subscription,
            [],
        );
        $sub->cancel();


        
    }

    // {
    //     "created": 1326853478,
    //     "livemode": false,
    //     "id": "evt_00000000000000",
    //     "type": "charge.dispute.closed",
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
    //         "created": 1600648536,
    //         "currency": "usd",
    //         "evidence": {
    //           "access_activity_log": null,
    //           "billing_address": null,
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
    //           "uncategorized_text": "Here is some evidence"
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
    //         "status": "won"
    //       }
    //     }
    //   }

   
}