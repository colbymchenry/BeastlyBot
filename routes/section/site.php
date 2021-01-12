<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('site/welcome');
});
Route::get('/faq', function () {
    return view('site/faq');
});
Route::get('/about', function () {
    return view('site/about');
});
Route::get('/status', function () {
    return view('site/status');
});
Route::get('/terms', function () {
    return view('site/terms');
});
Route::get('/privacy', function () {
    return view('site/privacy');
});
Route::get('/maintenance', function () {
    return view('site/maintenance');
});
Route::get('/404', function () {
    return view('errors/404');
});
