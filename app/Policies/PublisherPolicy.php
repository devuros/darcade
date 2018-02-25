<?php

namespace App\Policies;

use App\User;
use App\Publisher;
use Illuminate\Auth\Access\HandlesAuthorization;

class PublisherPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isAdmin())
        {
            return true;
        }
    }

    public function view(User $user, Publisher $publisher)
    {
        //
    }

    public function store(User $user)
    {
        return false;
    }

    public function update(User $user, Publisher $publisher)
    {
        return false;
    }

    public function delete(User $user, Publisher $publisher)
    {
        return false;
    }

}
