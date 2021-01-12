<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\WebhookClient\Models\WebhookCall;

class PaymentFailed implements ShouldQueue
{
    // TODO: Not sure here
    public function handle(WebhookCall $webhookCall)
    {
    }

    // {
    //     "id": "evt_1HQGQCHTMWe6sDFb6rfPRTmk",
    //     "object": "event",
    //     "api_version": "2019-08-14",
    //     "created": 1599846747,
    //     "data": {
    //       "object": {
    //         "id": "in_1HQGQAHTMWe6sDFbJ86OHH5l",
    //         "object": "invoice",
    //         "account_country": "US",
    //         "account_name": "BeastlyBot",
    //         "amount_due": 1000,
    //         "amount_paid": 1000,
    //         "amount_remaining": 0,
    //         "application_fee_amount": null,
    //         "attempt_count": 1,
    //         "attempted": true,
    //         "auto_advance": false,
    //         "billing": "charge_automatically",
    //         "billing_reason": "subscription_create",
    //         "charge": "ch_1HQGQBHTMWe6sDFbDcWDMrkF",
    //         "collection_method": "charge_automatically",
    //         "created": 1599846746,
    //         "currency": "usd",
    //         "custom_fields": null,
    //         "customer": "cus_Hzejn102gol501",
    //         "customer_address": null,
    //         "customer_email": "colbymchenry@gmail.com",
    //         "customer_name": null,
    //         "customer_phone": null,
    //         "customer_shipping": null,
    //         "customer_tax_exempt": "none",
    //         "customer_tax_ids": [
    //         ],
    //         "default_payment_method": null,
    //         "default_source": null,
    //         "default_tax_rates": [
    //         ],
    //         "description": null,
    //         "discount": null,
    //         "discounts": [
    //         ],
    //         "due_date": null,
    //         "ending_balance": 0,
    //         "footer": null,
    //         "hosted_invoice_url": "https://pay.stripe.com/invoice/acct_1FF2w1HTMWe6sDFb/invst_I0GyBoM3EENpBgXOYOCON26f96eH7G5",
    //         "invoice_pdf": "https://pay.stripe.com/invoice/acct_1FF2w1HTMWe6sDFb/invst_I0GyBoM3EENpBgXOYOCON26f96eH7G5/pdf",
    //         "lines": {
    //           "object": "list",
    //           "data": [
    //             {
    //               "id": "sli_bc37a7b46c8156",
    //               "object": "line_item",
    //               "amount": 1000,
    //               "currency": "usd",
    //               "description": "1 × Premium Callout Group (at $10.00 / month)",
    //               "discount_amounts": [
    //               ],
    //               "discountable": true,
    //               "discounts": [
    //               ],
    //               "livemode": false,
    //               "metadata": {
    //               },
    //               "period": {
    //                 "end": 1602438746,
    //                 "start": 1599846746
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
    //               "proration": false,
    //               "quantity": 1,
    //               "subscription": "sub_I0GyJhJrdhdlV8",
    //               "subscription_item": "si_I0GyVmbmxD6YwT",
    //               "tax_amounts": [
    //               ],
    //               "tax_rates": [
    //               ],
    //               "type": "subscription",
    //               "unique_id": "il_1HQGQAHTMWe6sDFbsP905rL2"
    //             }
    //           ],
    //           "has_more": false,
    //           "total_count": 1,
    //           "url": "/v1/invoices/in_1HQGQAHTMWe6sDFbJ86OHH5l/lines"
    //         },
    //         "livemode": false,
    //         "metadata": {
    //         },
    //         "next_payment_attempt": null,
    //         "number": "399ED757-0027",
    //         "paid": true,
    //         "payment_intent": "pi_1HQGQAHTMWe6sDFb4FsqTJaN",
    //         "period_end": 1599846746,
    //         "period_start": 1599846746,
    //         "post_payment_credit_notes_amount": 0,
    //         "pre_payment_credit_notes_amount": 0,
    //         "receipt_number": null,
    //         "starting_balance": 0,
    //         "statement_descriptor": null,
    //         "status": "paid",
    //         "status_transitions": {
    //           "finalized_at": 1599846746,
    //           "marked_uncollectible_at": null,
    //           "paid_at": 1599846747,
    //           "voided_at": null
    //         },
    //         "subscription": "sub_I0GyJhJrdhdlV8",
    //         "subtotal": 1000,
    //         "tax": null,
    //         "tax_percent": null,
    //         "total": 1000,
    //         "total_discount_amounts": [
    //         ],
    //         "total_tax_amounts": [
    //         ],
    //         "transfer_data": null,
    //         "webhooks_delivered_at": null
    //       }
    //     },
    //     "livemode": false,
    //     "pending_webhooks": 3,
    //     "request": {
    //       "id": "req_82cS4VMHkr2BYR",
    //       "idempotency_key": null
    //     },
    //     "type": "invoice.payment_succeeded"
    //   }
}