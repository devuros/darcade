<?php

namespace App\Policies;

use App\User;
use App\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isAdmin())
        {
            return true;
        }
    }

    public function index(User $user)
    {
        return false;
    }

    public function showUserRoles(User $user)
    {
        return false;
    }

    public function view(User $user, Role $role)
    {
        return false;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, Role $role)
    {
        return false;
    }

    public function delete(User $user, Role $role)
    {
        return false;
    }

}
