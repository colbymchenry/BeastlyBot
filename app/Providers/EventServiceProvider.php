<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    // protected $listen = [
    //     Registered::class => [
    //         SendEmailVerificationNotification::class,
    //     ],
    // ];

    protected $listen = [
        'stripe-webhooks::invoice.payment_succeeded' => [
            \App\Webhooks\Stripe\PaymentSucceeded::class,
        ],
        'stripe-webhooks::invoice.payment_failed' => [
            \App\Webhooks\Stripe\PaymentFailed::class,
        ],
        'stripe-webhooks::customer.subscription.deleted' => [
            \App\Webhooks\Stripe\SubscriptionCanceled::class,
        ],
        'stripe-webhooks::subscription_schedule.expiring' => [ // TODO: Need to test if this works
            \App\Webhooks\Stripe\SubscriptionExpired::class,
        ],
        'stripe-webhooks::charge.dispute.created' => [ 
            \App\Webhooks\Stripe\DisputeCreated::class,
        ],
        'stripe-webhooks::charge.dispute.closed' => [
            \App\Webhooks\Stripe\DisputeClosed::class,
        ],
        'stripe-webhooks::charge.dispute.updated' => [
            \App\Webhooks\Stripe\DisputeUpdated::class,
        ],
        'stripe-webhooks::charge.dispute.funds_reinstated' => [
            \App\Webhooks\Stripe\DisputeFundsReinstated::class,
        ],
        'stripe-webhooks::charge.dispute.funds_withdrawn' => [
            \App\Webhooks\Stripe\DisputeFundsWithdrawn::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
