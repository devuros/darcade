<?php

namespace App\Policies;

use App\User;
use App\Developer;
use Illuminate\Auth\Access\HandlesAuthorization;

class DeveloperPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the developer.
     *
     * @param  \App\User  $user
     * @param  \App\Developer  $developer
     * @return mixed
     */
    public function view(User $user, Developer $developer)
    {
        //
    }

    /**
     * Determine whether the user can store developers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function store(User $user)
    {

        return $user->isAdmin();

    }

    /**
     * Determine whether the user can update the developer.
     *
     * @param  \App\User  $user
     * @param  \App\Developer  $developer
     * @return mixed
     */
    public function update(User $user, Developer $developer)
    {
        //
    }

    /**
     * Determine whether the user can delete the developer.
     *
     * @param  \App\User  $user
     * @param  \App\Developer  $developer
     * @return mixed
     */
    public function delete(User $user, Developer $developer)
    {
        //
    }
}
