<?php

namespace App;

use Exception;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public function getDiscordHelper(): DiscordHelper {
        return new DiscordHelper($this);
    }

    public function getStripeHelper(): StripeHelper {
        return new StripeHelper($this);
    }

    public function hasStripeAccount(): bool {
        return $this->getStripeHelper()->getCustomerAccount() != null;
    }

    public function DiscordOAuth()
    {
        return $this->hasOne(DiscordOAuth::class);
    }

    public function StripeConnect()
    {
        return $this->hasOne(StripeConnect::class);
    }

    public function getPlanExpiration() {
        try {
            $subscription = $this->getStripeHelper()->getExpressSubscription();
            if($subscription == null || $subscription->status != 'active') return null;
            return $subscription->current_period_end;
        }catch(Exception $e) {
            return null;
        }
        return null;
    }

    public function canAcceptPayments(): bool {
        return $this->getStripeHelper()->isExpressUser();
    }

}
