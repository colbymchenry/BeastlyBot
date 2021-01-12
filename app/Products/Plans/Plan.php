<?php

namespace App\Products\Plans;

use App\Products\ProductMsgException;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\StripeHelper;

abstract class Plan 
{
  
    protected $product;
    protected $stripe_plan_obj;
    public $interval, $interval_cycle;

    public function __construct(\App\Products\Product $product, string $interval, string $interval_cycle = null)
    {
        $this->product = $product;
        $this->interval = $interval;
        $this->interval_cycle = $interval_cycle;
        if(('day' && 'week' && 'year' && 'month') != $interval) throw new ProductMsgException('Invalid interval.');


        if(Cache::has('plan_' . $this->getStripeID())) {
            if(Cache::get('plan_' . $this->getStripeID()) != 'null') {
                $this->stripe_plan_obj = Cache::get('plan_' . $this->getStripeID());
            }
        } else {
            StripeHelper::setApiKey();
            try {
                $this->stripe_plan_obj = \Stripe\Plan::retrieve($this->getStripeID());
                Cache::put('plan_' . $this->getStripeID(), $this->stripe_plan_obj, 60 * 10);
            } catch (\Exception $e) {
                Cache::put('plan_' . $this->getStripeID(), "null", 60 * 10);
            }
        }
        
    }

    public function getProduct(): \App\Products\Product {
        return $this->product;
    }

    public function create(Request $request) {
        $price = $request['price'];

        if (! $this->validPrice($price)) throw new ProductMsgException('Invalid price for ' . $this->interval_cycle . ' ' . $this->interval . '.');

        // if the plan already exists, delete it.
        try {
            $this->delete($request);
        } catch (\Exception $e) {
        }

        if($price < 1) return;

        $plan = \Stripe\Plan::create([
            "amount" => $price * 100,
            "interval" => $this->interval,
            "interval_count" => $this->interval_cycle,
            "product" => $this->product->getStripeID(),
            "currency" => "usd",
            'metadata' => [
                'user_id' => auth()->user()->id
            ],
            "id" => $this->getStripeID(),
        ]);

        Cache::put('plan_' . $this->getStripeID(), $plan, 60 * 10);

        return response()->json(['success' => true, 'msg' => 'Plan created!', 'active' => true]);
    }
    
    /* 
        Plans on Stripe are immutable by design, meaning you can't change the price. 
        However, you can delete the plan and re-create it at a new price, with the same name and plan_id. 
        Internally Stripe will continue to use the old plan for existing customers.
    */
    public function delete(Request $request) {
        StripeHelper::setApiKey();
        try {
            if($this->getStripePlan() !== null) {
                Cache::forget('plan_' . $this->getStripeID());
                $this->getStripePlan()->delete();
            }
        } catch(\Exception $e) {}
    }

    abstract public function update(Request $request);

    abstract public function getStripeID(): string;

    public function getStripePlan() {
        return $this->stripe_plan_obj;
    }

    protected function validPrice($input): bool {
        return $input === null || $input === '' || preg_match('/^[0-9]+(?:\.[0-9]{0,2})?$/', $input);
    }
    
}