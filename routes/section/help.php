<?php
use Illuminate\Support\Facades\Route;

Route::get('/help', function () { //
    return view('/help/home');
});
Route::get('/help/category-name', function () { //
    return view('/help/articles');
});
Route::get('/help/category-name/article', function () { //
    return view('/help/article');
});
