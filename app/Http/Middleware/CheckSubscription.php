<?php

namespace App\Http\Middleware;

use Closure;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $serviceId)
    {
        // Find if user has subscribed to this service
        if ( isSubscribed( $serviceId ) && isSubscribed( $serviceId )->status == 'subscribed' ) {
            return $next($request);
        }
        abort(403);
    }
}
