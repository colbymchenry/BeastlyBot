<?php


use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use \App\StripeHelper;

Route::get('/checkout-success', 'OrderController@checkoutSuccess');

Route::get('/checkout-cancel', 'OrderController@checkoutCancel');

Route::get('/slide-invoice', function() {
    $invoice = null;
    $id = \request('id');

    if(Cache::has('invoice_' . $id)) {
        $invoice = Cache::get('invoice_' . $id);
    } else {
        StripeHelper::setApiKey();
        try {
            $invoice = \Stripe\Invoice::retrieve($id);
            Cache::put('invoice_' . $id, $invoice, 60 * 10);
        } catch (\Exception $e) {
            if (env('APP_DEBUG')) Log::error($e);
        }
    }

        
    if($invoice != null) {
        $discord_helper = new \App\DiscordHelper(\App\User::where('id', \request('user_id'))->first());
        $guild = $discord_helper->getGuild(\request('guild_id'));
        $role = $discord_helper->getRole($guild->id, \request('role_id'));
        return view('slide.slide-invoice')->with('invoice', $invoice)->with('username', $discord_helper->getUsername())->with('role', $role)->with('guild', $guild);
    } else {
        abort(404);
    }
});

Route::get('/checkout', 'OrderController@checkout');

Route::post('/process-checkout', 'OrderController@setup');

