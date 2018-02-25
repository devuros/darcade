<?php

namespace App\Policies;

use App\User;
use App\Developer;
use Illuminate\Auth\Access\HandlesAuthorization;

class DeveloperPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isAdmin())
        {
            return true;
        }
    }

    public function view(User $user, Developer $developer)
    {
        //
    }

    public function store(User $user)
    {
        return false;
    }

    public function update(User $user, Developer $developer)
    {
        return false;
    }

    public function delete(User $user, Developer $developer)
    {
        return false;
    }

}
