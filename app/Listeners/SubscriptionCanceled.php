<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\WebhookClient\Models\WebhookCall;
use \App\EndedSubscription;
use \App\StripeConnect;
use \App\DiscordOAuth;
use \App\DiscordStore;
use \App\Stat;
use RestCord\DiscordClient;
use Illuminate\Support\Facades\Cache;
use \App\Subscription;
use Illuminate\Support\Facades\Log;

class SubscriptionCanceled implements ShouldQueue
{
    public function handle(WebhookCall $webhookCall)
    {
        $subscription_id = $webhookCall->payload['data']['object']['items']['data'][0]['subscription'];
        $plan_id = $webhookCall->payload['data']['object']['items']['data'][0]['plan']['id'];

      /*  try {
            $subscription = Subscription::where($subscription_id)->first();
            if($subscription->status <= 3){
                $subscription->status = 2;
                $subscription->save();
            }
        }
        catch (ApiErrorException $e) {
            if (env('APP_DEBUG')) Log::error($e);
            Log::info("Sub canceled (2) did not save in DB: ", $subscription_id);
            // Failed to Transfer
        }*/

        if(strpos($plan_id, 'discord') !== false) {
            $customer = $webhookCall->payload['data']['object']['customer'];
            $customer_id = StripeConnect::where('customer_id', $customer)->first()->user_id;
            $customer_discord_id = DiscordOAuth::where('user_id', $customer_id)->first()->discord_id;
            $partner_id = $webhookCall->payload['data']['object']['items']['data'][0]['plan']['metadata']['user_id'];
            $partner_discord_id = DiscordOAuth::where('user_id', $customer_id)->first()->discord_id;
            $discord_helper = new \App\DiscordHelper(\App\User::where('id', $customer_id)->first());
            $data = explode('_', $plan_id);
        
            if($data[0] == 'discord') {
                Cache::forget('customer_subscriptions_active_' . $customer_id);
                Cache::forget('customer_subscriptions_canceled_' . $customer_id);

                $guild_id = $data[1];
                $role_id = $data[2];

                try {
                    $discord_client = new DiscordClient(['token' => env('DISCORD_BOT_TOKEN')]); // Token is required
                    $discord_client->guild->removeGuildMemberRole([
                        'guild.id' => intval($guild_id),
                        'role.id' => intval($role_id),
                        'user.id' => intval($customer_discord_id)
                    ]);

                    $guild = $discord_helper->getGuild($guild_id);
                    $role = $discord_helper->getRole($guild_id, $role_id);

                    $discord_helper->sendMessage('Your subscription to the ' . $role->name . ' role in the ' . $guild->name . ' server was canceled. I removed the role from your account.');

                    try {
                        $subscription = Subscription::where('id', $subscription_id)->first();
                        if($subscription->status <= 3){
                            $subscription->status = 4;
                            $subscription->save();

                            $discord_store = DiscordStore::where("guild_id", $guild_id)->first();
                        
                            $stats = Stat::where('type', 1)->where('type_id', $discord_store->id)->first();
                            $subscribers_active = $stats->data['subscribers']['active'];
                            $subscribers_total = $stats->data['subscribers']['total'];

                            $stats_data = $stats->data;
                            $stats_data['subscribers'] = ['active' => $subscribers_active - 1, 'total' => $subscribers_total];
                            $stats->data = $stats_data;
                            $stats->save();


                        }
                    }
                    catch (ApiErrorException $e) {
                        if (env('APP_DEBUG')) Log::error($e);
                        Log::info("Sub canceled (5) did not save in DB: ", $subscription_id);
                        // Failed to Transfer
                    }

                } catch(\Exception $e) {
                    $discord_helper->sendMessage('Uh-oh! Something went wrong in removing the role from your account. Don\'t worry, I still canceled the subscription for you.');
                    $discord_error = new \App\DiscordError();
                    $discord_error->guild_id = $guild_id;
                    $discord_error->role_id = $role_id;
                    $discord_error->user_id = $customer_id;
                    $discord_error->message = $e->getMessage();

                    if (env('APP_DEBUG')) Log::error($e);
                }
            }
        }
    }

    #
    # IMMEDIATE CANCEL RESULT
    #
    #
    // {
    //     "id": "evt_1HQHPGHTMWe6sDFbhCARKa1v",
    //     "object": "event",
    //     "api_version": "2019-08-14",
    //     "created": 1599850534,
    //     "data": {
    //       "object": {
    //         "id": "sub_I0Ho1XUfX96y1u",
    //         "object": "subscription",
    //         "application_fee_percent": null,
    //         "billing": "charge_automatically",
    //         "billing_cycle_anchor": 1599849916,
    //         "billing_thresholds": null,
    //         "cancel_at": null,
    //         "cancel_at_period_end": false,
    //         "canceled_at": 1599850534,
    //         "collection_method": "charge_automatically",
    //         "created": 1599849916,
    //         "current_period_end": 1602441916,
    //         "current_period_start": 1599849916,
    //         "customer": "cus_Hzejn102gol501",
    //         "days_until_due": null,
    //         "default_payment_method": "pm_1HQHFHHTMWe6sDFbnKkzQ70T",
    //         "default_source": null,
    //         "default_tax_rates": [
    //         ],
    //         "discount": null,
    //         "ended_at": 1599850534,
    //         "invoice_customer_balance_settings": {
    //           "consume_applied_balance_on_void": true
    //         },
    //         "items": {
    //           "object": "list",
    //           "data": [
    //             {
    //               "id": "si_I0HoUVAJ6vZ6FX",
    //               "object": "subscription_item",
    //               "billing_thresholds": null,
    //               "created": 1599849917,
    //               "metadata": {
    //               },
    //               "plan": {
    //                 "id": "discord_590728038849708043_596078383906029590_1_r",
    //                 "object": "plan",
    //                 "active": true,
    //                 "aggregate_usage": null,
    //                 "amount": 1000,
    //                 "amount_decimal": "1000",
    //                 "billing_scheme": "per_unit",
    //                 "created": 1599704617,
    //                 "currency": "usd",
    //                 "interval": "month",
    //                 "interval_count": 1,
    //                 "livemode": false,
    //                 "metadata": {
    //                   "user_id": "1"
    //                 },
    //                 "nickname": null,
    //                 "product": "discord_590728038849708043_596078383906029590",
    //                 "tiers": null,
    //                 "tiers_mode": null,
    //                 "transform_usage": null,
    //                 "trial_period_days": null,
    //                 "usage_type": "licensed"
    //               },
    //               "price": {
    //                 "id": "discord_590728038849708043_596078383906029590_1_r",
    //                 "object": "price",
    //                 "active": true,
    //                 "billing_scheme": "per_unit",
    //                 "created": 1599704617,
    //                 "currency": "usd",
    //                 "livemode": false,
    //                 "lookup_key": null,
    //                 "metadata": {
    //                   "user_id": "1"
    //                 },
    //                 "nickname": null,
    //                 "product": "discord_590728038849708043_596078383906029590",
    //                 "recurring": {
    //                   "aggregate_usage": null,
    //                   "interval": "month",
    //                   "interval_count": 1,
    //                   "trial_period_days": null,
    //                   "usage_type": "licensed"
    //                 },
    //                 "tiers_mode": null,
    //                 "transform_quantity": null,
    //                 "type": "recurring",
    //                 "unit_amount": 1000,
    //                 "unit_amount_decimal": "1000"
    //               },
    //               "quantity": 1,
    //               "subscription": "sub_I0Ho1XUfX96y1u",
    //               "tax_rates": [
    //               ]
    //             }
    //           ],
    //           "has_more": false,
    //           "total_count": 1,
    //           "url": "/v1/subscription_items?subscription=sub_I0Ho1XUfX96y1u"
    //         },
    //         "latest_invoice": "in_1HQHFIHTMWe6sDFbkU7Tj2Nw",
    //         "livemode": false,
    //         "metadata": {
    //         },
    //         "next_pending_invoice_item_invoice": null,
    //         "pause_collection": null,
    //         "pending_invoice_item_interval": null,
    //         "pending_setup_intent": null,
    //         "pending_update": null,
    //         "plan": {
    //           "id": "discord_590728038849708043_596078383906029590_1_r",
    //           "object": "plan",
    //           "active": true,
    //           "aggregate_usage": null,
    //           "amount": 1000,
    //           "amount_decimal": "1000",
    //           "billing_scheme": "per_unit",
    //           "created": 1599704617,
    //           "currency": "usd",
    //           "interval": "month",
    //           "interval_count": 1,
    //           "livemode": false,
    //           "metadata": {
    //             "user_id": "1"
    //           },
    //           "nickname": null,
    //           "product": "discord_590728038849708043_596078383906029590",
    //           "tiers": null,
    //           "tiers_mode": null,
    //           "transform_usage": null,
    //           "trial_period_days": null,
    //           "usage_type": "licensed"
    //         },
    //         "quantity": 1,
    //         "schedule": null,
    //         "start": 1599849916,
    //         "start_date": 1599849916,
    //         "status": "canceled",
    //         "tax_percent": null,
    //         "transfer_data": null,
    //         "trial_end": null,
    //         "trial_start": null
    //       }
    //     },
    //     "livemode": false,
    //     "pending_webhooks": 3,
    //     "request": {
    //       "id": "req_NhOrZEuMlfb6ih",
    //       "idempotency_key": null
    //     },
    //     "type": "customer.subscription.deleted"
    //   }
}