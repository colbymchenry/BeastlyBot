<?php

namespace App\Http\Controllers;

use App\DiscordOAuth;
use App\StripeConnect;
use App\User;
use App\StripeHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Wohali\OAuth2\Client\Provider\Discord;

class DiscordOAuthController extends Controller {

    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    public function connect() {
        if (!\request()->exists('code')) {
            // AlertHelper::alertDanger('Failed to connect Discord account!');
            return redirect('/');
        }
        
        $provider = self::getProvider();
        $user = null;
        try {
            // generate an access token with the oauth2 code provided by Discord
            $token = $provider->getAccessToken('authorization_code', [
                'code' => \request('code'),
            ]);
            // grab the discord user from the access token generated above
            $discord_user = $provider->getResourceOwner($token);


            // Check if a user already exists in our DB with the discord user.id of the logged in oauth2 user
            if (DiscordOAuth::where('discord_id', $discord_user->getId())->exists()) {
                $user = DiscordOAuth::where('discord_id', $discord_user->getId())->first()->user;
                auth()->login($user);
            }
            // if the user does not exists we need to create the user and log them in
            if ($user === null) {
                $user = new User();
                $user->save();
                $oauth = new DiscordOAuth
                ([
                    'user_id' => $user->id,
                    'discord_id' => $discord_user->getId(), 
                    'access_token' => $token->getToken(), 
                    'refresh_token' => $token->getRefreshToken(), 
                    'token_expiration' => $token->getExpires()
                ]);
                $user->DiscordOAuth()->save($oauth);
                auth()->login($user);
            } else {
                // if the user does exist we just update their tokens
                $user->DiscordOAuth->access_token = $token->getToken();
                $user->DiscordOAuth->refresh_token = $token->getRefreshToken();
                $user->DiscordOAuth->token_expiration = $token->getExpires();
                $user->DiscordOAuth->save();
            }
            // if the authenticated user does not have a strip account we need to create one for them
            if (! StripeConnect::where('user_id', $user->id)->exists()) {
                // Any time accessing Stripe API this snippet of code must be ran above any preceding API calls
                StripeHelper::setApiKey();

                $customers_with_email = \Stripe\Customer::all(['limit' => 1, 'email' => $discord_user->getEmail()]);
                $stripe_account = null;

                foreach($customers_with_email as $cus) {
                    if($cus->email === $discord_user->getEmail()) {
                        $stripe_account = $cus;
                        break;
                    }
                }

                if($stripe_account == null) {
                    $stripe_account = \Stripe\Customer::create([
                        "email" => $discord_user->getEmail(),
                        "metadata" => ['discord_id' => $discord_user->getId()]
                    ]);
                } else {
                    \Stripe\Customer::update($stripe_account->id, ['metadata' => ['discord_id' => $discord_user->getId()]]);
                }

                $connect = new StripeConnect(['user_id' => $user->id, 'customer_id' => $stripe_account->id]);
                $user->StripeConnect()->save($connect);

                // Add welcome message/email or something
            }
        } catch (IdentityProviderException $e) {
            if (env('APP_DEBUG')) Log::error($e);
            if($user != null) $user->delete();
        }


        try {
            if (request()->cookie('next_url') != NULL){
                $user->url_next = request()->cookie('next_url');
                $user->save();
            }
        }
        catch (IdentityProviderException $e) {
            if (env('APP_DEBUG')) Log::error($e);
        }
        /**
         * if the CheckoutSession has a destination the user is manually going to go to it, otherwise they are just logging
         * in and we will direct them to the dashboard
         **/
    
        if($user->url_next){
            $next_url = $user->url_next;
            if(strpos($next_url, 'slide-') !== false){
                if(strpos($next_url, 'account-') !== false){
                    return redirect('dashboard');
                }
                else if(strpos($next_url, 'server-') !== false){
                    return redirect('servers');
                }
                else if(strpos($next_url, 'roles-') !== false){
                    return redirect('servers');
                }
                else if(strpos($next_url, 'promotions') !== false){
                    return redirect('promotions');
                }
                else if(strpos($next_url, 'product-') !== false){
                    return redirect('dashboard');
                }
                else{
                    return redirect('dashboard');
                }
            }else if ((strpos($next_url, 'bknd00') !== false) || (strpos($next_url, 'connect_stripe') !== false)){
                return redirect('dashboard');
            }else{
                return redirect($user->url_next);
            }
            $user->url_next = NULL;
            $user->save();
        }else{
            if (Session::has('next_path')) {
                return redirect(Session::get('next_path'));
            } else {
                return redirect('dashboard');
            }
        }

        //return redirect()->intended('/dashboard');
    }

    /**
     * This method is used to get the Discord Provider to access the Discord API
     * @return Discord
     */
    public static function getProvider() {
        return new Discord([
            'clientId' => env('DISCORD_CLIENT_ID'),
            'clientSecret' => env('DISCORD_CLIENT_SECRET'),
            'redirectUri' => env('APP_URL') . '/discord_oauth',
        ]);
    }

}
