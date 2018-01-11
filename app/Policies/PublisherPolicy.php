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

    /**
     * Determine whether the user can view the publisher.
     *
     * @param  \App\User  $user
     * @param  \App\Publisher  $publisher
     * @return mixed
     */
    public function view(User $user, Publisher $publisher)
    {
        //
    }

    /**
     * Determine whether the user can store publishers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function store(User $user)
    {

        return false;

    }

    /**
     * Determine whether the user can update the publisher.
     *
     * @param  \App\User  $user
     * @param  \App\Publisher  $publisher
     * @return mixed
     */
    public function update(User $user, Publisher $publisher)
    {

        return false;

    }

    /**
     * Determine whether the user can delete the publisher.
     *
     * @param  \App\User  $user
     * @param  \App\Publisher  $publisher
     * @return mixed
     */
    public function delete(User $user, Publisher $publisher)
    {

        return false;

    }
}
