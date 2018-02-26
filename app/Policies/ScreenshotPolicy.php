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

}
