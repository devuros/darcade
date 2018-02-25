<?php

namespace App\Policies;

use App\User;
use App\Review;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isAdmin())
        {
            return true;
        }
    }

    public function view(User $user, Review $review)
    {
        //
    }

    public function store(User $user)
    {
        return true;
    }

    public function update(User $user, Review $review)
    {
        return $user->id === $review->user_id;
    }

    public function delete(User $user, Review $review)
    {
        return $user->id === $review->user_id;
    }

}
