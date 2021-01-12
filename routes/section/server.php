<?php

use App\DiscordStore;

use App\Shop;
use App\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use App\StripeHelper;

Route::post('/refresh-roles/{guild_id}', function($guild_id) {
    Cache::forget('roles_' . $guild_id);
    return redirect('/server/' . $guild_id);
});

Route::get('/servers', 'ServerController@getServers');

Route::get('/server/{id}', 'ServerController@getServerPage');

Route::post('/get-active-roles', 'ServerController@getActiveRoles');

Route::post('/get-status-roles', 'ServerController@getStatusRoles');

Route::get('/get-latest-transactions', 'ServerController@getRecentTransactions');

Route::get('/get-disputes', 'ServerController@getDisputes');

Route::get('/slide-server-settings/{id}', function ($id) {
    return view('/slide/slide-server-settings')->with('shop', DiscordStore::where('guild_id', $id)->first());
});
Route::get('/slide-list-products/{id}', function ($id) {
    return view('/slide/slide-server-list-products')->with('id', $id)->with('shop', DiscordStore::where('guild_id', $id)->first());
});

Route::get('/slide-roles-settings/{guild_id}/{role_id}', 'ServerController@getSlideRoleSettings');

Route::get('/slide-special-roles-settings/{guild_id}/{role_id}/{type}/{discord_id}', 'ServerController@getSlideSpecialRoleSettings');

Route::get('/slide-roles-prices/{guild_id}/{role_id}', 'ServerController@getSlideRolePrices');

Route::get('/slide-server-member', function () {
    StripeHelper::setApiKey();
    $discord_helper = new \App\DiscordHelper(\App\User::where('id', \request('user_id'))->first());
    $discord_store = \App\DiscordStore::where('id', \request('store_id'))->first();
    $invoices = [];

    foreach(\App\Subscription::where('store_id', $discord_store->id)->where('user_id', \request('user_id'))->get() as $subscription) {
        if(Cache::has('invoices_' . $subscription->id)) {
            $invoices[$subscription->id] = Cache::get('invoices_' . $subscription->id);
        } else {
            Cache::put('invoices_' . $subscription->id, \Stripe\Invoice::all(['subscription' => $subscription->id]), 60 * 30);
            $invoices[$subscription->id] = Cache::get('invoices_' . $subscription->id);
        }
    }

    return view('/slide/slide-server-member')->with('discord_helper', $discord_helper)->with('discord_store', $discord_store)->with('user_id', \request('user_id'))->with('invoices', $invoices);
});

Route::get('/slide-server-member-role-add/{guild_id}/{user_id}', function ($guild_id, $user_id) {
    $user = User::where('discord_id', $user_id)->get()[0];
    return view('/slide/slide-server-member-role-add')->with('guild_id', $guild_id)->with('user', $user);
});
Route::post('/server-member-role-add', 'ServerController@memberRoleAdd');
//Route::get('/slide-server-member-role-add/{guild_id}/{role_id}', 'ServerController@getSlideRoleSettings');
//Route::get('/slide-server-member-role-add/{guild_id}/{user_id}', 'ServerController@memberAddRole');

Route::post('/save-server-settings', 'ServerController@updateShop');

Route::post('/save-go-live', 'ServerController@updateStatus');

Route::post('/bknd-000/ban-user-from-store', 'ServerController@banUserFromStore');
