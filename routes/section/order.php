<?php

use App\SiteConfig;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::get('/checkout-success', 'OrderController@checkoutSuccess');

Route::get('/checkout-cancel', 'OrderController@checkoutCancel');

Route::get('/slide-invoice/{id}', function($id) {
    \Stripe\Stripe::setApiKey(SiteConfig::get('STRIPE_SECRET'));
    try {
        $invoice = \Stripe\Invoice::retrieve($id);
        return view('slide.slide-invoice')->with('invoice', $invoice);
    } catch (\Exception $e) {
        if (env('APP_DEBUG')) Log::error($e);
        return view('slide.slide-invoice')->with('invoice', null);
    }
});

Route::get('/checkout', 'OrderController@checkout');

Route::post('/process-checkout', 'OrderController@setup');

