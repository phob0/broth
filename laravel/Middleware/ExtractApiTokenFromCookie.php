<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Crypt;

class ExtractApiTokenFromCookie
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
        if ($token = $request->get('api_token')) {
            $request->headers->set('Authorization', 'Bearer ' . $token);
        } else if ($request->cookie('app_auth')) { // ignore any Authorization tokens
            $request->headers->set('Authorization', 'Bearer ' . $request->cookie('app_auth'));
        }

        return $next($request);
    }
}
