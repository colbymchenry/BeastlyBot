<?php

namespace App\Products;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\StripeHelper;

abstract class Product 
{
  
    protected $product_type;
    protected $stripe_product_obj;

    public function __construct(string $product_type)
    {
        $this->product_type = $product_type;

        if(Cache::has('product_' . $this->getStripeID())) {
            if(Cache::get('product_' . $this->getStripeID()) != 'null') {
                $this->stripe_product_obj = Cache::get('product_' . $this->getStripeID());
            }
        } else {
            StripeHelper::setApiKey();
            try {
                $this->stripe_product_obj = \Stripe\Product::retrieve($this->getStripeID());
                Cache::put('product_' . $this->getStripeID(), $this->stripe_product_obj, 60 * 10);
            } catch (\Exception $e) {
                Cache::put('product_' . $this->getStripeID(), "null", 60 * 10);
            }
        }
        
    }

    abstract public function checkoutValidate(): void;

    abstract public function checkoutSuccess();

    abstract public function checkoutCancel();

    abstract public function create(Request $request);

     // can't delete a product if there are any \Stripe\Plan's still with active \Stripe\Subscription's on them.
    public function delete(Request $request) {
        if($this->stripe_product_obj != null)
            $this->stripe_product_obj->delete();
    }

    public function update(Request $request) {}

    abstract public function getCallbackParams(): array;

    abstract public function getStripeID(): string;

    public function getCallbackSuccessURL(): string {
        $data = $this->getCallbackParams();
        $data['success'] = true;
        $data['product_type'] = $this->product_type;
        return env('APP_URL') . '/checkout?' . http_build_query($data);
    }

    public function getCallbackCancelURL(): string {
        $data = $this->getCallbackParams();
        $data['success'] = false;
        $data['product_type'] = $this->product_type;
        return env('APP_URL') . '/checkout?' . http_build_query($data);
    }

    public function getStripeProduct() {
        return $this->stripe_product_obj;
    }

    public function getExpressOwnerID() {
        if($this->stripe_product_obj != null) {
            return $this->stripe_product_obj->metadata['owner_id'];
        }
        return null;
    }

    protected function validPrice($input): bool {
        return $input === null || $input === '' || preg_match('/^[0-9]+(?:\.[0-9]{0,2})?$/', $input);
    }

    abstract public function getStripePlan();

}
