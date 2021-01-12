<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function listShopOwners() {

        // Any time accessing Stripe API this snippet of code must be ran above any preceding API calls
        // \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        // $shops = Shop::all();

        // $shops_array = $shops->toArray();

        // usort($shops_array, function($a, $b) {
        //     return $b['created_at'] <=> $a['created_at'];
        // });

        // return view('admin.shop_owners')->with('shops', $shops);


        //$shops_array = $shops->toArray();

     //   $owners = \Stripe\Account::all([
        //    'limit' => 100
       // ]);

        //$owners_array = $owners->data;

        //usort($shops_array, function($a, $b) {
        //    return $b['created_at'] <=> $a['created_at'];
        //});

        // return view('admin.shop_owners')->with('owners', $shops);

    }


}
