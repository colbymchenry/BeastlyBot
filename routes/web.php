<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::stripeWebhooks('stripe_webhooks');

Route::get('/slide-account-type', function () {
    return view('/slide/slide-account-type');
});

Route::get('/slide-help-titles', function () {
    return view('slide/help/slide-help-titles');
});
Route::get('/slide-help-create-a-product', function () {
    return view('slide/help/slide-help-create-a-product');
});
Route::get('/slide-help-ultimate-shop-guide', function () {
    return view('slide/help/slide-help-ultimate-shop-guide');
});
Route::get('/slide-help-managing-subscriptions', function () {
    return view('slide/help/slide-help-managing-subscriptions');
});
Route::get('/slide-help-requesting-a-refund', function () {
    return view('slide/help/slide-help-requesting-a-refund');
});
Route::get('/slide-help-remove-bot', function () {
    return view('slide/help/slide-help-remove-bot');
});
Route::get('/slide-help-withdraw-earnings', function () {
    return view('slide/help/slide-help-withdraw-earnings');
});
Route::get('/slide-help-creating-a-promotion', function () {
    return view('slide/help/slide-help-creating-a-promotion');
});

Route::get('/impersonate/{id}', 'UserController@impersonate');

require_once __DIR__ . "/section/site.php";


require_once __DIR__ . "/section/auth.php";
require_once __DIR__ . "/section/help.php";

/**
 * All routes that require authentication
 */


 Route::group(['middleware' => ['auth', 'web']], function () {

    Route::get('/slide-help-creating-a-promotion', function () {
        return view('slide/help/slide-help-creating-a-promotion');
    });

    require_once __DIR__ . "/section/account.php";
    require_once __DIR__ . "/section/server.php";
    require_once __DIR__ . "/section/coupon.php";
    require_once __DIR__ . "/section/product.php";
    require_once __DIR__ . "/section/order.php";
    require_once __DIR__ . "/section/admin.php";
    require_once __DIR__ . "/section/ticket.php";
});


/* test */
