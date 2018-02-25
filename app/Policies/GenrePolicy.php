<?php

namespace App\Policies;

use App\User;
use App\Genre;
use Illuminate\Auth\Access\HandlesAuthorization;

class GenrePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isAdmin())
        {
            return true;
        }
    }

    public function view(User $user, Genre $genre)
    {
        //
    }

    public function store(User $user)
    {
        return false;
    }

    public function update(User $user, Genre $genre)
    {
        return false;
    }

    public function delete(User $user, Genre $genre)
    {
        return false;
    }

}
