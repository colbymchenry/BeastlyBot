<?php

namespace App;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Subscription;

class StripeHelper
{

    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function getSubscriptions($status) {
        $cache_key = 'customer_subscriptions_' . $status . '_' . auth()->user()->id;
        if(Cache::has($cache_key)) {
            return Cache::get($cache_key);
        } else {
            \Stripe\Stripe::setApiKey(env('STRIPE_CLIENT_SECRET'));
            $stripe_subs = \Stripe\Subscription::all(['customer' => $this->user->StripeConnect->customer_id, 'status' => $status, 'limit' => 100]);
            Cache::put($cache_key, $stripe_subs, 60 * 10);
        }

        return Cache::get($cache_key, array());
    }

    public function ownsSubscription($sub_id) {
        \Stripe\Stripe::setApiKey(env('STRIPE_CLIENT_SECRET'));
        $stripe_sub = \Stripe\Subscription::retrieve(
            $sub_id
            []
        );

        return $stripe_sub->customer == $this->user->StripeConnect->customer_id;
    }

    public function isSubscribedToProduct(string $id): bool {
        foreach ($this->getSubscriptions('active') as $subscription) {
            if ($subscription->items->data[0]->plan->product == $id) return true;
        }

        return false;
    }

    public function getSubscriptionForProduct(string $id): \Stripe\Subscription {
        foreach ($this->getSubscriptions('active') as $subscription) {
            if ($subscription->items->data[0]->plan->product == $id) return $subscription;
        }
        return null;
    }

    public function isSubscribedToPlan(string $id): bool {
        foreach ($this->getSubscriptions('active') as $subscription) {
            if ($subscription->items->data[0]->plan->id == $id) return true;
        }

        return false;
    }

    public function isSubscribedToID(string $id): bool {
        foreach ($this->getSubscriptions('active') as $subscription) {
            if ($subscription->id == $id) return true;
        }

        return false;
    }

    public function getSubscriptionForPlan(string $id): \Stripe\Subscription {
        foreach ($this->getSubscriptions('active') as $subscription) {
            if ($subscription->items->data[0]->plan->id == $id) return $subscription;
        }
        return null;
    }

    public function getStripeEmail(): string {
        if (Session::has('stripe_email')) return Session::get('stripe_email');
        \Stripe\Stripe::setApiKey(env('STRIPE_CLIENT_SECRET'));

        try {
            Session::put('stripe_email', $this->getCustomerAccount()->email);
            return Session::get('stripe_email');
        } catch (ApiErrorException $e) {
        }

        return null;
    }

    public function getCustomerAccount(): \Stripe\Customer {
        \Stripe\Stripe::setApiKey(env('STRIPE_CLIENT_SECRET'));
        try {
            return \Stripe\Customer::retrieve($this->user->StripeConnect->customer_id);
        } catch (ApiErrorException $e) {
        }
        return null;
    }

    public function isSubscriptionMonthly(): bool {
        $active_plan = $this->getExpressSubscription();
        return $active_plan !== null && $active_plan->id == env('LIVE_MONTHLY_PLAN_ID');
    }

    public function isSubscriptionYearly(): bool {
        $active_plan = $this->getExpressSubscription();
        return $active_plan !== null && $active_plan->id == env('LIVE_YEARLY_PLAN_ID');
    }

    public function getExpressSubscription() {
        foreach($this->getSubscriptions('active') as $subscription) {
            if ($subscription->items->data[0]->plan->id == env('LIVE_MONTHLY_PLAN_ID') 
            || $subscription->items->data[0]->plan->id == env('LIVE_YEARLY_PLAN_ID'))  return $subscription;
        }

        return null;
    }

    public function isExpressUser(): bool {
        return $this->user->StripeConnect->express_id !== null;
    }

    public function hasExpressPlan(): bool {
        return $this->getExpressSubscription() != null;
    }

    public function hasActiveExpressPlan(): bool {
        $subscription = $this->getExpressSubscription();
        return $subscription != null && $subscription->status == 'active';
    }

    public function getBalance() {
        if(Cache::has('balance_' . $this->user->StripeConnect->express_id)) return Cache::get('balance_' . $this->user->StripeConnect->express_id, 0);
        \Stripe\Stripe::setApiKey(env('STRIPE_CLIENT_SECRET'));
        $balance = \Stripe\Balance::retrieve(
            ['stripe_account' => $this->user->StripeConnect->express_id]
        );
        Cache::put('balance_' . $this->user->StripeConnect->express_id, $balance, 60 * 5); // 5 minutes
        return Cache::get('balance_' . $this->user->StripeConnect->express_id, 0);
    }

    public function getLoginURL() {
        \Stripe\Stripe::setApiKey(env('STRIPE_CLIENT_SECRET'));
        return $this->isExpressUser() ? \Stripe\Account::createLoginLink($this->user->StripeConnect->express_id)->url : null;
    }

    public static function getAccountFromStripeConnect(string $code): \Stripe\Account {
        $token_request_body = array(
            'client_secret' => env('STRIPE_CLIENT_SECRET'),
            'grant_type' => 'authorization_code',
            'client_id' => env('STRIPE_CLIENT_ID'),
            'code' => $code,
        );
        $req = curl_init('https://connect.stripe.com/oauth/token');
        curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($req, CURLOPT_POST, true);
        curl_setopt($req, CURLOPT_POSTFIELDS, http_build_query($token_request_body));
        // TODO: Additional error handling
        $respCode = curl_getinfo($req, CURLINFO_HTTP_CODE);
        $resp = json_decode(curl_exec($req), true);
        curl_close($req);

        \Stripe\Stripe::setApiKey(env('STRIPE_CLIENT_SECRET'));

        return \Stripe\Account::retrieve($resp['stripe_user_id']);
    }

}
