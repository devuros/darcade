<?php

namespace App\Policies;

use App\User;
use App\Cart;
use Illuminate\Auth\Access\HandlesAuthorization;

class CartPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Cart $cart)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, Cart $cart)
    {
        //
    }

    public function delete(User $user, Cart $cart)
    {
        return $user->id === $cart->user_id;
    }

}
