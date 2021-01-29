<?php

namespace App\Http\Middleware;

use App\Http\Controllers\AdminArea\LogoutController;
use App\Http\Controllers\AuthController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if(!$request->is("admin/*") && $request->hasHeader("Auth")){
            (new AuthController())->base_index($request);
        }
        return $next($request);
    }
}
