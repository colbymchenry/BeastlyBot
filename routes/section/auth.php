<?php

use Illuminate\Support\Facades\Route;

Route::get('/discord_login', function () {
    // Illuminate\Support\Facades\Session::flush();
    return view('discord_login');
})->name('discord_login');

Route::get('/discord_oauth', 'DiscordOAuthController@connect');

Route::get('/logout', function () {
    // Illuminate\Support\Facades\Session::flush();
    auth()->logout();
    return redirect()->to('https://beastlybot.com');
})->name('logout');

Route::get('/dashboard', function() {
    if(Auth::check()){
        $stripe_helper = auth()->user()->getStripeHelper();
        $discord_helper = new \App\DiscordHelper(auth()->user());

        return view('dashboard')->with('stripe_helper', $stripe_helper)->with('discord_helper', $discord_helper);
    }else{
        return view('discord_login');
    }
});

// Route::get('/', function() {
//     return redirect()->to('https://beastlybot.com');
// });
