<?php

namespace App\Policies;

use App\User;
use App\Wish;
use Illuminate\Auth\Access\HandlesAuthorization;

class WishPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isAdmin())
        {
            return true;
        }
    }

    public function view(User $user, Wish $wish)
    {
        //
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Wish $wish)
    {
        //
    }

    public function delete(User $user, Wish $wish)
    {
        return $user->id === $wish->user_id;
    }

}
