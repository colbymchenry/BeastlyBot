<?php

use App\Shop;
use App\DiscordStore;
use App\DiscordHelper;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Products\DiscordRoleProduct;
use App\Products\Plans\DiscordPlan;
use Illuminate\Support\Facades\Cache;

Route::get('/slide-product-purchase/{guild_id}/{role_id}', function($guild_id, $role_id) {
    if(\request('affiliate_id') !== null) {
        return view('slide.slide-product-purchase')->with('shop', DiscordStore::where('guild_id', $guild_id)->first())->with('role_id', $role_id)->with('prices', ProductController::getPricesForRole($guild_id, $role_id))->with('affiliate_id', \request('affiliate_id'));
    }

    $discord_helper = new DiscordHelper(auth()->user());
    $guild = $discord_helper->getGuild($guild_id);
    $role = $discord_helper->getRole($guild_id, $role_id);
    $plans = array();

    foreach(array(1, 3, 6, 12) as $months) {
        $discord_product = new DiscordRoleProduct($guild_id, $role_id, $months);
        $plan = new DiscordPlan($discord_product, 'month', $months);

        if($plan->getStripePlan() != null) {
            array_push($plans, $plan);
        }
    }

    return view('slide.slide-product-purchase')->with('guild', $guild)->with('plans', $plans)->with('discord_helper', $discord_helper)->with('role', $role)->with('store', DiscordStore::where('guild_id', $guild_id)->first());
});

Route::get('/slide-special-purchase/{guild_id}/{role_id}/{special_id}/{discord_id}', function($guild_id, $role_id, $special_id, $discord_id) {
    return view('slide.slide-product-purchase')->with('guild_id', $guild_id)->with('role_id', $role_id)->with('special_id', $special_id)->with('prices', ProductController::getPricesForSpecial($guild_id, $role_id, $discord_id));
});

Route::get('/product/{id}', function () {
    return view('subscribe-product');
});
//Route::group(['domain' => 'shop.'.env('APP_URL')], function () {
//Route::group(['domain' => 'beastly.store'], function () {
    Route::get('/shop/{guild_id}', 'ProductController@getShop');
//});

Route::get('/shop/{guild_id}/{affiliate_id}', function ($guild_id, $affiliate_id) {
    if (\App\Affiliate::where('id', $affiliate_id)->exists()) {
        return view('subscribe')->with('guild_id', $guild_id)->with('descriptions', \App\RoleDesc::where('guild_id', $guild_id)->get())
            ->with('affiliate', \App\Affiliate::where('id', $affiliate_id)->get()[0]);
    } else {
        return view('subscribe')->with('guild_id', $guild_id)->with('descriptions', \App\RoleDesc::where('guild_id', $guild_id)->get());
    }
});
Route::post('/get-special-roles', 'ServerController@getSpecialRoles');

Route::post('/process-special-checkout', 'OrderController@specialProcess');

Route::post('/check-prices', 'ProductController@checkProductPrices');

Route::post('/product', 'ProductController@product');

Route::post('/plan', 'ProductController@plan');

Route::post('/update_product_desc', 'ProductController@setProductDescription');