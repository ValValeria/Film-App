<?php

namespace App\Http\Middleware;

use App\Http\Controllers\AdminArea\LogoutController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class AdminMiddleware
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
        if(Auth::check()){
            $response = Gate::inspect("isadmin");

            if ($response->allowed()) {
                return $next($request);
            } else{
                (new LogoutController())($request);
            }
        } 
        return redirect()->route('login');
    }
}
