<?php

namespace App\Products\Plans;

use Illuminate\Support\Facades\Cache;
use App\StripeHelper;
//use App\Products\ProductMsgException;

class DiscordPlan extends Plan
{

    public function update(\Illuminate\Http\Request $request)
    {
        $this->product->createProduct();

        $stripe = StripeHelper::getStripeClient();
        
        if(! \App\DiscordStore::where('guild_id', $this->product->guild_id)->exists()) {
            $this->product->discord_store = DiscordStore::create([
                'guild_id' => $this->product->guild_id,
                'url' => $this->product->guild_id,
                'user_id' => auth()->user()->id
            ]);
        }

        $same_price = false;

        if($this->getStripePlan() !== null) {
            if($this->getStripePlan()->amount != intval($request['price']) * 100) {
                try {
                    $stripe->plans->delete($this->getStripeID(), []);
                } catch (\Exception $e) {}
            } else {
                $same_price = true;
            }
        }

        if($request['price'] < 1){
            return response()->json(['success' => false, 'msg' => 'Price too low.']);
            //throw new ProductMsgException('Price too low. Must be at least $1.00 USD');
        }

        if($request['price'] > 0 && !$same_price) {
            $plan = $stripe->plans->create([
                "amount" => intval($request['price']) * 100,
                "interval" => $this->interval,
                "interval_count" => $this->interval_cycle,
                "product" => $this->product->getStripeID(),
                "currency" => "usd",
                'metadata' => [
                    'user_id' => auth()->user()->id
                ],
                "id" => $this->getStripeID(),
            ]);

            Cache::forget('plan_' . $this->getStripeID());
            Cache::put('plan_' . $this->getStripeID(), $plan, 60 * 10);
        }
        
        return response()->json(['success' => true, 'msg' => 'Prices updated.']);
    }

    public function create(\Illuminate\Http\Request $request)
    {
        $this->product->createProduct();

        try {
            parent::create($request);
            if(! \App\DiscordStore::where('guild_id', $this->product->guild_id)->exists()) {
                $this->product->discord_store = DiscordStore::create([
                    'guild_id' => $this->product->guild_id,
                    'url' => $this->product->guild_id,
                    'user_id' => auth()->user()->id
                ]);
            }

            $key = 'price_' . $this->product->getStripeID() . '_' . $this->interval_cycle;
            Cache::put($key, $request['price'], 60 * 5);
        } catch(\Exception $e) {
            \Log::info($e);
        }

        return response()->json(['success' => true, 'msg' => 'Plan created.']);
    }

    public function getStripeID(): string
    {
        return $this->product->getStripeID() . '_' . $this->interval_cycle . '_r';
    }

}