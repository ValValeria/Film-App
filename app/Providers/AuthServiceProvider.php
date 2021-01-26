<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\MessagePolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Message;

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
        Message::class=>MessagePolicy::class
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

        Gate::define("view-messages", function (User $user, User $user2) {
            return $user->id == $user2->id
                ? Response::allow()
                : Response::deny(json_encode(["errors" => ["You are allowed"]]));
        });
    }
}
