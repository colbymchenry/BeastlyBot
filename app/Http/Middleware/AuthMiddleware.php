<?php


namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AuthMiddleware {
    public function handle($request, Closure $next)
    {
        // return auth()->guest() ? redirect('/discord_login') : $next($request);


        Session::put('next_path', $request->path());
        $next_url = $request->path();
        \Cookie::queue('next_url', $next_url, '5');
        //Session::put('next_path', URL::previous());

       /* if (auth()->guest()) {
            return redirect('/discord_login');
        } else {

            try {
                Auth::user()->getDiscordData();
            } catch(\Exception $e) {
                Log::error($e);
                Auth::logout();
                return redirect('/discord_login');
            }

            if(Auth::user()->stripe_id === null) {
               Auth::logout();
               return redirect('/discord_login');
            }
        }

        return $next($request);*/
         return auth()->guest() ? redirect('/discord_login') : $next($request);
        //return redirect(Session::get('next_path'));
    }
}
