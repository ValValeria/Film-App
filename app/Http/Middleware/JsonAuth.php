<?php

namespace App\Http\Middleware;

use App\Http\Controllers\AuthController;
use Closure;
use Illuminate\Http\Request;

class JsonAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    { 
        if(!$request->route()->named('api.login') && !$request->route()->named('api.signup')){
            (new AuthController())->base_index($request);
        }
        return $next($request);
    }
}
