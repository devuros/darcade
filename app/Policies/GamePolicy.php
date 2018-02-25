<?php

namespace App\Policies;

use App\User;
use App\Game;
use Illuminate\Auth\Access\HandlesAuthorization;

class GamePolicy
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

    public function view(User $user, Game $game)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, Game $game)
    {
        //
    }

    public function delete(User $user, Game $game)
    {
        //
    }

}
