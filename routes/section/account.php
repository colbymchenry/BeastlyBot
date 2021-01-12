<?php

use App\AlertHelper;

use App\DiscordHelper;
use App\Subscription;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Log;
#use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\StripeHelper;

Route::group(['middleware' => ['auth', 'web']], function () {
    Route::view('/account/settings', 'account.settings');

    Route::get('/slide-account-settings', function() {
        return UserController::getViewWithInvoices('slide.slide-account-settings', 5);
    });

    Route::get('/account/payments', function() {
        return UserController::getViewWithInvoices('account.payments', 100);
    });

    Route::get('/slide-account-payments', function() {
        return UserController::getViewWithInvoices('slide.slide-account-payments', 100);
    });

    Route::get('/account/subscriptions', function() {
        return view('subscriptions')->with('discord_helper', new \App\DiscordHelper(auth()->user()));
    });

    Route::get('/slide-account-subscriptions', function() {
        return UserController::getViewWithSubscriptions('slide.slide-account-subscriptions');
    });

    Route::view('/slide-account-complete', '/slide/slide-account-complete');

    Route::view('/slide-notifications', '/slide/slide-notifications');

    Route::get('/connect_stripe', 'StripeConnectController@connect');

    Route::get('/slide-payout/{id}', 'UserController@getPayoutSlide');

    Route::get('/payout/{amount}', 'UserController@payout');

    Route::post('/cancel-subscription', 'UserController@cancelSubscription');

    Route::post('/undo-cancel-subscription', 'UserController@undoCancelSubscription');

    Route::post('/request-subscription-refund', 'UserController@requestSubscriptionRefund');

    Route::post('/request-subscription-decision', 'UserController@decisionRefundRequest');

    Route::post('/buy-plan', 'UserController@checkoutExpressPlan');

    Route::get('/buy-plan-success', 'UserController@checkoutExpressPlanSuccess');

    Route::get('/buy-plan-cancel', 'UserController@checkoutExpressPlanFailure');

    Route::get('/slide-account-subscription-settings', function () {
        $id = \request('id');
        StripeHelper::setApiKey();

        $role_name = \request('role_name');
        $guild_name = \request('guild_name');
        $role_color = \request('role_color');

        try {

            $sub = \Stripe\Subscription::retrieve($id);
            $latest_invoice = \Stripe\Invoice::retrieve($sub->latest_invoice);

            $diff = time() - $sub->start_date;
            $days = round($diff / (60 * 60 * 24));

            $subscription = Subscription::where('id', $id)->first();

            return view('/slide/slide-account-subscription-settings')->with('sub', $sub)->with('latest_invoice', $latest_invoice)->with('role_name', $role_name)->with('subscription', $subscription)->
            with('guild_name', $guild_name)->with('role_color', $role_color)->with('days_passed', $days);
        } catch(\Exception $e) {
            if (env('APP_DEBUG')) Log::error($e);
            AlertHelper::alertError('Error!');
        }


    });

    Route::get('/bknd00/get_notifications', function() {
        return response()->json([
            'unread_count' => Notification::where('user', auth()->user()->id)->where('read', false)->count(),
            'notifications' => Notification::where('user', auth()->user()->id)->orderBy('created_at', 'desc')->get()]);
    });

    Route::get('/bknd00/mark-notification-read/{id}', function($id) {
        if(Notification::where('id', $id)->where('user', auth()->user()->id)->where('read', false)->exists()) {
            $notification = Notification::where('id', $id)->where('user', auth()->user()->id)->where('read', false)->get()[0];
            $notification->read = true;
            $notification->save();
        }
    });


    Route::post('/change_night_mode', function(Request $request) {
        try {
            $user = auth()->user();
            $user->mode = $request['mode'] == '1';
            $user->save();
        } catch (\Exception $e) {
            if (env('APP_DEBUG')) Log::error($e);
        }

        return response()->json(['success' => true]);
    });

    Route::get('/bknd00/get-servers-and-stores', 'UserController@getServersandStores');

});
