<?php

namespace App\Http\Controllers;


use App\AlertHelper;
use App\DiscordStore;
#use App\Shop;
use App\User;
use App\Product;
use App\ProductRole;
use App\Products\DiscordRoleProduct;
use App\Refund;
use DateTime;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Stripe\Exception\InvalidRequestException;
use App\DiscordHelper;
use App\Subscription;
use App\PaidOutInvoice;
use App\Stat;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class ServerController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function getServers(){
        $discord_helper = new DiscordHelper(auth()->user());
        if(\request('slide') == 'true') {
            return view('slide.slide-servers')->with('guilds', $discord_helper->getOwnedGuilds());
        } else {
            return view('servers')->with('guilds', $discord_helper->getOwnedGuilds());
        }
    }

    public static function getUsersRoles($store_id) {
        $subscriptions = Subscription::where('store_id', $store_id)->get();

        // TODO: Fix this for the subscribers tab. 
        // Also need to fix the servers list subscribers count because if I subscribed to premium and new role it says the subscribers, really 1 subscriber and 2 susbcriptions for that 1 subscriber
        $users_roles = [];

        foreach($subscriptions as $subscription) {
            $roles1 = array();
            foreach(Subscription::select('metadata')->where('store_id', $store_id)->where('user_id', $subscription->user_id)->where('status', '<=', 3)->get() as $metadata) {
                if(!in_array($metadata->metadata['role_id'], $roles1)) {
                    array_push($roles1, $metadata->metadata['role_id']);
                }
            }

            if(!in_array($subscription->user_id, $users_roles)) {
                $users_roles[$subscription->user_id] = $roles1;
            }
        }

        return $users_roles;
    }

    /* --------------------------------------------------------------------
        ServerController: getServerPage

        /server/{id} -> Create Shop -> return view server

        Quick check and array push for Stripe active roles.
        1) Get $id
        2) Create shop
        3) Check if Stripe account has order
        4) Return server view

        Used:
        -- server blade: the page
    -------------------------------------------------------------------- */

    public function getServerPage($id){
        $discord_helper = new DiscordHelper(auth()->user());

       /*if(! $discord_helper->ownsGuild($id)) {
            AlertHelper::alertError('You are not the owner of that server!');
            return redirect('/dashboard');
        }*/

        $discord_store = null;

        if(! DiscordStore::where('guild_id', $id)->exists()) {
            $discord_store = new DiscordStore(['guild_id' => $id, 'url' => $id, 'user_id' => auth()->user()->id]);
            $discord_store->save();

            $stats = new Stat(['type' => 1, 'type_id' => $discord_store->id]);
            $stats->data = ['subscribers' => ['active' => 0, 'total' => 0], 'disputes' => ['active' => 0, 'total' => 0]];
            $stats->save();
            
        } else {
            $discord_store = DiscordStore::where('guild_id', $id)->first();

            $stats = Stat::where('type', 1)->where('type_id', $discord_store->id)->first();
        }

        $roles = $discord_helper->getRoles($id);

        $active = array();
        $subscribers = [];

        foreach($roles as $role) {
            $discord_product = new DiscordRoleProduct($id, $role->id, null);
            $stripe_product = $discord_product->getStripeProduct();
            if($stripe_product != null && $stripe_product->active) {
                array_push($active, $role->id);
                $subscribers[$role->id] = Subscription::where('store_id', $discord_store->id)->where('status', '<=', 3)->where('status', '<=', 2)->where('metadata', 'LIKE', '%' . $role->id . '%')->count();
            } else {
                $subscribers[$role->id] = 0;
            }
        }

        // TODO: Fix this for the subscribers tab. 
        // Also need to fix the servers list subscribers count because if I subscribed to premium and new role it says the subscribers, really 1 subscriber and 2 susbcriptions for that 1 subscriber
        $users_roles = $this::getUsersRoles($discord_store->id);

        // 1 got to make paid out table work
        $total_payout = PaidOutInvoice::where('store_id', $discord_store->id)->whereNull('refunded')->whereNull('reversed')->sum('amount');
        // 2
        $average_weekly = PaidOutInvoice::where('store_id', $discord_store->id)->whereNull('refunded')->whereNull('reversed')->whereBetween('created_at', [Carbon::now()->subDays(8), Carbon::now()])->sum('amount');
        // 3
        $pending_payout = Subscription::where('store_id', $discord_store->id)->whereNull('latest_paid_out_invoice_id')->where('status', '<=', 4)->orWhereRaw('latest_paid_out_invoice_id != latest_invoice_id')->where('store_id', $discord_store->id)->where('status', '<=', 4)->sum('latest_invoice_amount');
        // $pending_total = Subscription::where('store_id', $discord_store->id)->where(Carbon::createFromFormat('Y-m-d', 'latest_invoice_paid_at') > Carbon::now()->subDays(15))->sum('reward');
        $subscriptions = Subscription::where('store_id', $discord_store->id)->orderBy('updated_at', 'DESC')->paginate(5);

        // get all the invoices for payments tab
        \Stripe\Stripe::setApiKey(env('STRIPE_CLIENT_SECRET'));
        $invoices = [];
    
        foreach(\App\Subscription::where('store_id', $discord_store->id)->get() as $subscription) {
            if(Cache::has('invoices_' . $subscription->id)) {
                $invoices[$subscription->id] = Cache::get('invoices_' . $subscription->id);
            } else {
                Cache::put('invoices_' . $subscription->id, \Stripe\Invoice::all(['subscription' => $subscription->id]), 60 * 30);
                $invoices[$subscription->id] = Cache::get('invoices_' . $subscription->id);
            }
        }

        // TODO: Sort data in ASC order
        // usort($invoices_array, function($a, $b) {
        //     return $b['created'] <=> $a['created'];
        // });

        // TODO: Member count not working. Returns null in guild for some reason, so does members. Have to use old code to update member count
        return view('server')->with('id', $id)->with('shop', $discord_store)->with('has_order', false)->with('roles', $roles)->with('active_roles', $active)->with('guild', $discord_helper->getGuild($id))->with('subscribers', $subscribers)->with('total_payout', $total_payout)->with('pending_payout', $pending_payout)->with('average_weekly', $average_weekly)->with('users_roles', $users_roles)->with('invoices', $invoices)->with('subscriptions', $subscriptions)->with('bot_positioned', $discord_helper->isBotPositioned($id));
    }

    /* --------------------------------------------------------------------
        ServerController: getStatusRoles

        $request /get-status-roles -> Stripe API -> return array $status_roles

        Quick check and array push for Stripe active roles.
        1) Get $request roles array from SocketHandler (res_roles_ + socket_id)
        2) Check if roles active in Stripe, if not set false
        3) Send json array of role_id, boolean

        Used:
        -- server blade (roles_script): to un-hide active roles in list
    -------------------------------------------------------------------- */
    public static function getStatusRoles(Request $request){
        $roles = $request['roles'];

        $status_roles = array();
        // Any time accessing Stripe API this snippet of code must be ran above any preceding API calls
        \Stripe\Stripe::setApiKey(env('STRIPE_CLIENT_SECRET'));
        try {
            foreach ($roles as $role) {
                try {
                    $discord_product = new DiscordRoleProduct($role['guild_id'], $role['role_id'], null);
                    array_push($status_roles, ['product' => $role['role_id'], 'active' => $discord_product->getStripeProduct()->active, 'role_name' => $role['name']]);
                } catch (\Exception $e){
                    array_push($status_roles, ['product' => $role['role_id'], 'active' => false, 'role_name' => $role['name']]);
                }
            }
            return response()->json($status_roles);
        } catch (\Exception $e) {
            if (env('APP_DEBUG')) Log::error($e);
        }
    }

    /* --------------------------------------------------------------------
        ServerController: getSlideRoleSettings

        /slide-roles-settings/{guild_id}/{role_id} -> Stripe API -> return view

        1) Get $guild_id $role_id
        2) Check for Product in Stripe
        3) Return product + prices

        Used:
        -- server blade (roles_script): to show roles settings
    -------------------------------------------------------------------- */

    public static function getSlideRoleSettings($guild_id, $role_id) {
        // Any time accessing Stripe API this snippet of code must be ran above any preceding API calls
        \Stripe\Stripe::setApiKey(env('STRIPE_CLIENT_SECRET'));

        \Log::info($role_id);

        try {
            $discord_product = new DiscordRoleProduct($guild_id, $role_id, null);
            $product = $discord_product->getStripeProduct();
            $store = DiscordStore::where('guild_id', $guild_id)->first();
            $desc = ProductRole::where('discord_store_id', $store->id)->where('role_id', $role_id)->first();
            $shop_url = $store->url;
            $discord_helper = new \App\DiscordHelper(auth()->user());
            return view('slide.slide-roles-settings')->with('guild_id', $guild_id)->with('role', $discord_helper->getRole($guild_id, $role_id))->with('shop_url', $shop_url)->with('enabled', $product->active)->with('prices', ProductController::getPricesForRole($guild_id, $role_id))->with('desc', $desc);
        } catch (\Exception $e) {
            if (env('APP_DEBUG')) Log::error($e);
            return view('slide.slide-roles-settings')->with('enabled', false)->with('role', $discord_helper->getRole($guild_id, $role_id))->with('guild_id', $guild_id)->with('role_id', $role_id)->with('prices', ProductController::getPricesForRole($guild_id, $role_id));
        }
    }


        /* --------------------------------------------------------------------
        ServerController: getSlideSpecialRoleSettings

        /slide-roles-settings/{guild_id}/{role_id}/{discord_id}/{type} -> Stripe API -> return view

        1) Get $guild_id $role_id $discord_id $type (s or t)
        2) Check for Product in Stripe + special
        3) Return product + prices

        Used:
        -- slide-server-member: to show special roles settings
    -------------------------------------------------------------------- */

    public static function getSlideSpecialRoleSettings($guild_id, $role_id, $type, $discord_id) {
        // Any time accessing Stripe API this snippet of code must be ran above any preceding API calls
        \Stripe\Stripe::setApiKey(env('STRIPE_CLIENT_SECRET'));

        try {
            $product = \Stripe\Product::retrieve($guild_id . '_' . $role_id);
            $shop_url = DiscordStore::where('guild_id', $guild_id)->value('url');
            $user = User::where('discord_id', '=', $discord_id)->get()[0];
            return view('slide.slide-roles-settings')->with('shop_url', $shop_url)->with('enabled', $product->active)->with('guild_id', $guild_id)->with('role_id', $role_id)->with('special', true)->with('user', $user)->with('prices', ProductController::getPricesForSpecial($guild_id, $role_id, $discord_id));
        } catch (\Exception $e) {
            if (env('APP_DEBUG')) Log::error($e);
            return view('slide.slide-roles-settings')->with('enabled', false)->with('guild_id', $guild_id)->with('role_id', $role_id)->with('special', true)->with('user', $user)->with('prices', ProductController::getPricesForSpecial($guild_id, $role_id, $discord_id));
        }
    }

    /* --------------------------------------------------------------------
        ServerController: getRecentTransactions

        $request /get-latest-transactions -> Invoices (last 7 days) -> return array $recent_invoices

        1) Use $request to get $guild_id $roles <-- TODO: why roles?
        2) Pull all invoices from last 7 days
        3) Foreach invoice if stripe_express_id in metadata
        4) Array push $recent_invoices

        Used:
        -- server blade (server_script): fillRecentPayments()

        Cache: 2 minutes
    -------------------------------------------------------------------- */

    public function getRecentTransactions(Request $request) {
        $timeDiffs = [];
        $usernames = [];
        $discord_store = \App\DiscordStore::where('id', $request['store_id'])->first();
        $subscriptions = \App\Subscription::where('store_id', $request['store_id'])->whereDay('latest_invoice_paid_at', '=', date('d'))->whereMonth('latest_invoice_paid_at', '=', date('m'))->whereYear('latest_invoice_paid_at', '=', date('Y'))->orderBy('latest_invoice_paid_at', 'DESC')->take(25)->get();
        foreach($subscriptions as $sub) {
            $discord_helper = new \App\DiscordHelper(\App\User::where('id', $sub->user_id)->first());

            $start = new DateTime($sub->latest_invoice_paid_at);
            $end = new DateTime('NOW');
            $interval = $end->diff($start);
            $days = $interval->format('%d');
            $hours = 24 * $days + $interval->format('%h');
            $minutes = $interval->format('%i');

            $timeDiffs[$sub->id] = ['days' => $days, 'hours' => $hours, 'minutes' => $minutes];
            $usernames[$sub->id] = $discord_helper->getUsername();
        }
        return response()->json(['subscriptions' => $subscriptions, 'timeDiffs' => $timeDiffs, 'usernames' => $usernames, 'guild_id' => strval($discord_store->guild_id)]);
    }

    /* ServerController: getDisputes */
    public function getDisputes(Request $request) {
        \Stripe\Stripe::setApiKey(env('STRIPE_CLIENT_SECRET'));

        $id = $request['guild'];
        $guild = DiscordStore::where('guild_id', $id)->first();

        if(!\auth()->user()->getDiscordHelper()->ownsGuild($guild)) {
            return response()->json();
        }

        $unix_now = time();

        $disputes_array = array();

        foreach (Refund::where('guild_id', $guild)->get() as $dispute) {
            array_push($disputes_array, $dispute);
        }

        return response()->json($disputes_array);
    }


    /* --------------------------------------------------------------------
        ServerController: updateShop

        $request /save-server-settings -> Shop Table -> return response success => true/false

        1) Use $request to get shop details
        2) Create shop table if not already
        3) Check url exists already
        4) Update table
        4) Return response

        Used:
        -- server blade (slide-server-settings): saveServerSettings()
    -------------------------------------------------------------------- */

    public function updateShop(Request $request) {
        $guild_id = $request['id'];
        $desc = $request['description'];
        $url = $request['url'];
        $refunds_enabled = $request['refunds_enabled'];
        $refunds_days = $request['refunds_days'];
        $refunds_terms = $request['refunds_terms'];
        if($refunds_days == NULL){
            $refunds_days = 0;
        }

        if(!\auth()->user()->getDiscordHelper()->ownsGuild($guild_id)) 
            return response()->json(['success' => false, 'msg' => 'You are not the owner of this server.']);

        if(DiscordStore::where('url', strtolower($url))->where('guild_id', '!=', $guild_id)->exists()) 
            return response()->json(['success' => false, 'msg' => 'That URL is already in use.']);
            
        $shop = DiscordStore::where('guild_id', $guild_id)->first();
        $shop->url = $url;
        $shop->description = $desc;
        $shop->refunds_enabled = $refunds_enabled;
        $shop->refunds_days = $refunds_days;
        $shop->refunds_terms = $refunds_terms;
        $shop->save();

        return response()->json(['success' => true]);
    }

    /* --------------------------------------------------------------------
        ServerController: updateStatus

        $request /save-go-live -> Shop Table -> return response success => true/false

        1) Use $request to shop id and status
        2) Create shop table if not already
        3) Return false if !canAcceptPayments (shows modal)
        4) Check if Subscription still active (error 2)
        5) Save shop live true (Live), false (Test)
        6) Return response

        Used:
        -- server blade: onClick #live-switch #test-switch
    -------------------------------------------------------------------- */

    public function updateStatus(Request $request) {
        $id = $request['id'];
        $live = $request['live'];

        if(!\auth()->user()->getDiscordHelper()->ownsGuild(DiscordStore::where('id', $id)->value('guild_id'))) {
            return response()->json(['success' => false, 'msg' => 'You are not the owner of this server.']);
        }else {

            // check if stripe express user
           /* $owner_array = \App\User::where('id', (DiscordStore::where('guild_id', $id)->first()->user_id))->first();
            if(!$owner_array->getStripeHelper()->isExpressUser()){
                return response()->json(['success' => false, 'msg' => 'StripeError']);

            }else{*/
                if(!\auth()->user()->getStripeHelper()->hasActiveExpressPlan()){
                    //return response()->json(['success' => false]);
                    return response()->json(['success' => false, 'msg' => 'You cannot accept payments because you do not have an active plan.']);
                } else{
                    $shop = DiscordStore::where('id', $id)->first();
                    /*
                    if(\auth()->user()->error == '2'){
                        return response()->json(['success' => false, 'msg' => 'Please pay partner invoice to go Live.']);
                    }*/
                    if($live === "Live"){
                        $shop->live = true;
                        #$shop->owner_id = (\auth()->user()->id);
                    }
                    else{
                        $shop->live = false;
                    }
                    $shop->save();
                    return response()->json(['success' => true]);
                }

           // }
        }
    }

    public function banUserFromStore(Request $request){
        $user_id = $request['id'];
        $discord_id = $request['discord_id'];
        $type = 1;
        $discord_store_id = $request['discord_store_id'];
        $guild_id = $request['guild_id'];
        $until = $request['until'];
        $active = $request['active'];
        $reason = $request['reason'];

        return true;
    }

}


