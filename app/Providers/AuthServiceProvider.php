<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\OrderPolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Order'=>'App\Policies\OrderPolicy',
        'App\Models\Product' => 'App\Policies\ProductPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define("isadmin",function(User $user){
            return $user->status == "admin"
                            ? Response::allow()
                            : Response::deny(json_encode(["errors"=>["You are not the admin"]]));
                                            
        });
    }
}
