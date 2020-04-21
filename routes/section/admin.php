<?php

use App\BeastlyConfig;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['App\Http\Middleware\AdminMiddleware']], function () {

    Route::get('/admin', function () {
        return view('admin/dash');
    });

    Route::view('/admin/site/settings', 'admin.site_settings');

    Route::post('/admin/update_settings_defaults', function() {
        BeastlyConfig::setDefaultValues();
        return redirect('/admin/site/settings');
    });

    Route::post('/admin/update_settings', 'AdminController@setSiteConfigValue');

    Route::get('/admin/shop/owners', 'AdminController@listShopOwners');


    // Blog

    Route::get('/admin/blog', function () {
        return view('admin/blog');
    });
    Route::get('/admin/blog_create', function () {
        return view('admin/blog_create');
    });
    Route::get('/admin/blog_edit', function () {
        return view('admin/blog_edit');
    });
    Route::get('/admin/slide_blog_settings', function () {
        return view('admin/slide/slide_blog_settings');
    });

    Route::post('/admin/post_blog', 'BlogController@createPost');


});
