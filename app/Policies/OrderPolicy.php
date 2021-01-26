<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Optional;

class OrderPolicy
{
    use HandlesAuthorization;

    public function before(User $user,$ability)
    {
        return $user->status == "admin" && $ability!= "addOrder";
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Order  $order
     * @return mixed
     */
    public function view(User $user, Order $order)
    {
        return $user->id == $order->user->id;
    }

    public function addOrder(User $user)
    {
        return $user->status!="admin";
    }

    public function update(User $user, ?Order $order)
    {
        return $user->id == optional($order)->user->id;
    }
}
