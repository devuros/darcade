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

    /**
     * Determine whether the user can view the wish.
     *
     * @param  \App\User  $user
     * @param  \App\Wish  $wish
     * @return mixed
     */
    public function view(User $user, Wish $wish)
    {
        //
    }

    /**
     * Determine whether the user can create wishes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the wish.
     *
     * @param  \App\User  $user
     * @param  \App\Wish  $wish
     * @return mixed
     */
    public function update(User $user, Wish $wish)
    {
        //
    }

    /**
     * Determine whether the user can delete the wish.
     *
     * @param  \App\User  $user
     * @param  \App\Wish  $wish
     * @return mixed
     */
    public function delete(User $user, Wish $wish)
    {
        //
    }
}
