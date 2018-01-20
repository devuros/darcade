<?php

namespace App\Policies;

use App\User;
use App\Screenshot;
use Illuminate\Auth\Access\HandlesAuthorization;

class ScreenshotPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {

        if ($user->isAdmin())
        {

            return true;

        }

        return false;

    }

    /**
     * Determine whether the user can view the screenshot.
     *
     * @param  \App\User  $user
     * @param  \App\Screenshot  $screenshot
     * @return mixed
     */
    public function view(User $user, Screenshot $screenshot)
    {
        //
    }

    /**
     * Determine whether the user can create screenshots.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the screenshot.
     *
     * @param  \App\User  $user
     * @param  \App\Screenshot  $screenshot
     * @return mixed
     */
    public function update(User $user, Screenshot $screenshot)
    {
        //
    }

    /**
     * Determine whether the user can delete the screenshot.
     *
     * @param  \App\User  $user
     * @param  \App\Screenshot  $screenshot
     * @return mixed
     */
    public function delete(User $user, Screenshot $screenshot)
    {
        //
    }
}
