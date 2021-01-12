<?php

use Illuminate\Support\Facades\Route;
use App\StripeHelper;

Route::get('/promotions', 'PromotionController@getPromotionsPage');

Route::get('/slide-promotions-add-coupon', function () {
    return view('/slide/slide-promotions-add-coupon');
});

Route::post('/promotions-delete-coupon/{id}', 'PromotionController@deleteCoupon');

// Route::get('/slide-promotions-stats-coupon', function () {
//     return view('/slide/slide-promotions-stats-coupon');
// });

// Route::get('/slide-promotions-transactions-coupon', function () {
//     return view('/slide/slide-promotions-transactions-coupon');
// });

// Route::get('/slide-promotions-edit-coupon/{id}', function ($id) {
//     \Stripe\Stripe::setApiKey(envCLIENT_SECRET'));

//     try {
//         $stripe_promotion = \Stripe\Coupon::retrieve($id);
//         $fixed = $stripe_promotion->amount_off > 0;
//         return view('/slide/slide-promotions-edit-coupon')->with('promotion', $stripe_promotion)->with('fixed', $fixed);
//     } catch (\Exception $e) {
//     }
//     return 'Invalid promotion.';
// });

Route::post('/validate-coupon', function (\Illuminate\Http\Request $request) {
    StripeHelper::setApiKey();
    try {
        $user = \App\DiscordOAuth::where('discord_id', $request['owner_id'])->first();
        $stripe_promotion = \Stripe\Coupon::retrieve($user->user_id . $request['code']);
        return response()->json(['valid' => true, 'data' => $stripe_promotion->toArray()]);
    } catch (\Exception $e) {
    }
    return response()->json(['valid' => false]);
});

Route::post('/promotions-create-promotion', 'PromotionController@createPromotion');
