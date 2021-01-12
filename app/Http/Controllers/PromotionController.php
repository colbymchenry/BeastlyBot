<?php

namespace App\Http\Controllers;


use App\Coupon;
use App\Http\PayPal\PayPalRecurring;
use App\PricingTable;
use App\Promotion;
use App\User;
use App\StripeHelper;
use Discord\OAuth\Discord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class PromotionController extends Controller {


    private $minutes_to_cache = 10;

    public function __construct() {
        $this->middleware('auth');
    }

    // TODO: Cache this shit
    public function getPromotionsPage() {
        // Any time accessing Stripe API this snippet of code must be ran above any preceding API calls
        StripeHelper::setApiKey();

        $coupons = array();

        // Grab all the Coupons that the Partner has made in the DB and send to view at bottom
        foreach(Coupon::where('owner_id', auth()->user()->id)->get() as $coupon) {
            try {
                $cache_key = 'coupon_' . $coupon->id;
                $coupon_array = [];
                if(Cache::has($cache_key)) {
                    $coupon_array = Cache::get($cache_key);
                } else {
                    $stripe_promotion = \Stripe\Coupon::retrieve($coupon->id);
                    $coupon_array = [
                        'id' => $stripe_promotion->id,
                        'percent_off' => $stripe_promotion->percent_off,
                        'amount_off' => $stripe_promotion->amount_off,
                        'uses' => $stripe_promotion->times_redeemed,
                        'duration' => $stripe_promotion->duration,
                        'duration_in_months' => $stripe_promotion->duration_in_months,
                        'max_uses' => $stripe_promotion->max_redemptions,
                        'valid' => $stripe_promotion->valid
                    ];
                    Cache::put($cache_key, $coupon_array, 60 * $this->minutes_to_cache);
                }

                $coupons[$coupon->id] = $coupon_array;
            } catch (\Exception $e) {
                if(env('APP_DEBUG')) Log::error($e);
            }
        }

        if(\request('slide') == 'true') {
            return view('slide.slide-promotions')->with('coupons', $coupons);
        }
        return view('promotions')->with('coupons', $coupons);
    }

    public function createPromotion(Request $request) {
        $code = auth()->user()->id  . $request['code'];
        $percentage = $request['percentage'];
        $fixed_amount = $request['fixed_amount'];
        $duration = $request['duration'];
        $months_in_effect = $request['months_in_effect'];

        $pattern = "/^[a-zA-Z0-9]+$/";
        if (!preg_match($pattern, $code))
            return response()->json(['success' => false, 'msg' => 'Invalid code. Code cannot contain spaces or special characters.']);

        if (!$this->validValue($fixed_amount))
            return response()->json(['success' => false, 'msg' => 'Invalid promotional value.']);

        if (!$this->validValue($percentage))
            return response()->json(['success' => false, 'msg' => 'Invalid promotional value.']);

        // Any time accessing Stripe API this snippet of code must be ran above any preceding API calls
        StripeHelper::setApiKey();

        try {
            $stripe_promotion = \Stripe\Coupon::retrieve($code);
            return response()->json(['success' => false, 'msg' => 'Promotion already exists.']);
        } catch (\Exception $e) {
        }

        $promo_data = [];
        $promo_data['id'] = $code;
        $promo_data['duration'] = $duration;
        if ($fixed_amount === null)
            $promo_data['percent_off'] = $percentage;
        else {
            $promo_data['amount_off'] = $fixed_amount * 100;
            $promo_data['currency'] = 'USD';
        }

        if($months_in_effect !== null && $months_in_effect > 0)
            $promo_data['duration_in_months'] = $months_in_effect;

        $promo_data['metadata']['owner_id'] = auth()->user()->id;

        try {
            $stripe_promotion = \Stripe\Coupon::create($promo_data);

            // store coupon in cache
            $coupon_array = [
                'id' => $stripe_promotion->id,
                'percent_off' => $stripe_promotion->percent_off,
                'amount_off' => $stripe_promotion->amount_off,
                'uses' => $stripe_promotion->times_redeemed,
                'duration' => $stripe_promotion->duration,
                'duration_in_months' => $stripe_promotion->duration_in_months,
                'max_uses' => $stripe_promotion->max_redemptions,
                'valid' => $stripe_promotion->valid
            ];
            Cache::put('coupon_' . $code, $coupon_array, 60 * $this->minutes_to_cache);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }

        $coupon = new Coupon();
        $coupon->id = $code;
        $coupon->owner_id = auth()->user()->id;
        $coupon->save();

        return response()->json(['success' => true, 'msg' => 'Promotion created!']);
    }

    public function deleteCoupon($id) {
        // Any time accessing Stripe API this snippet of code must be ran above any preceding API calls
        StripeHelper::setApiKey();

        $db_coupon = null;
        if(Coupon::where('id', $id)->exists()) {
            if(!Coupon::where('id', $id)->where('owner_id', auth()->user()->id)->exists()) {
                return response()->json(['success' => false, 'msg' => 'You are not the owner of that coupon.']);
            }
            $db_coupon = Coupon::where('id', $id)->get()[0];
        }

        try {
            $coupon = \Stripe\Coupon::retrieve($id);
            $coupon->delete();

            // remove coupon from cache
            Cache::forget('coupon_' . $id);

            if($db_coupon !== null) $db_coupon->delete();
        } catch(\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }

        return response()->json(['success' => true, 'msg' => $id]);
    }

    function checkBool($string) {
        $string = strtolower($string);
        return (in_array($string, array("true", "false", "1", "0", "yes", "no"), true));
    }

    function validValue($input) {
        return $input === null || $input === '' || preg_match('/^[0-9]+(?:\.[0-9]{0,2})?$/', $input);
    }

}
