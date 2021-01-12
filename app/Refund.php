<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    public $table = 'refunds';
   // public $incrementing = false;
    protected $primaryKey = 'id';

    public function getUser() {
        return User::where('id', $this->user_id)->get()[0];
    }

    public static function create($invoice_id, $sub_id, $sub_start_date, $sub_period_end, $sub_user_id, $owner_id, /*$sub_stripe_account_id, $sub_guild_name, $sub_role_name, $sub_guild_id, $sub_role_id, $sub_refund_enabled, $sub_refund_days, $sub_refund_terms,*/ $sub_description, $sub_plan_id, $sub_amount, $sub_application_fee) {
        if(Refund::where('sub_id', $sub_id)->exists()) return;

        $refund = new Refund();
        $refund->invoice_id = $invoice_id;
        $refund->sub_id = $sub_id;
        $refund->start_date = $sub_start_date;
        $refund->period_end = $sub_period_end;
        $refund->user_id = $sub_user_id;
        $refund->owner_id = $owner_id;
        /*$refund->stripe_account_id = $sub_stripe_account_id;
        $refund->guild_name = $sub_guild_name;
        $refund->role_name = $sub_role_name;
        $refund->guild_id = $sub_guild_id;
        $refund->role_id = $sub_role_id;
        $refund->refund_enabled = $sub_refund_enabled;
        $refund->refund_days = $sub_refund_days;
        $refund->refund_terms = $sub_refund_terms;*/
        $refund->description = $sub_description;
        $refund->plan_id = $sub_plan_id;
        $refund->amount = $sub_amount;
        $refund->application_fee = $sub_application_fee;

        $refund->save();
    }
}
