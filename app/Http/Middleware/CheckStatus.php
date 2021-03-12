<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //If the status is not approved redirect to login 
        if( Auth::guard()->check() && Auth::guard()->user()->status !== '1'){
            Auth::logout();
            return redirect()->route('login')->with('error', 'Your account is not active. Contact Administrator.');
        }

        return $next($request);
    }
}
