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

    public function view(User $user, Screenshot $screenshot)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, Screenshot $screenshot)
    {
        //
    }

    public function delete(User $user, Screenshot $screenshot)
    {
        //
    }

}
