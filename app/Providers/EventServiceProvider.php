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
            \App\Listeners\PaymentSucceeded::class,
        ],
        'stripe-webhooks::invoice.payment_failed' => [
            \App\Listeners\PaymentFailed::class,
        ],
        'stripe-webhooks::customer.subscription.deleted' => [
            \App\Listeners\SubscriptionCanceled::class,
        ],
        'stripe-webhooks::subscription_schedule.expiring' => [ // TODO: Need to test if this works
            \App\Listeners\SubscriptionExpired::class,
        ],
        'stripe-webhooks::checkout.session.completed' => [
            \App\Listeners\CheckoutSessionCompleted::class,
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
