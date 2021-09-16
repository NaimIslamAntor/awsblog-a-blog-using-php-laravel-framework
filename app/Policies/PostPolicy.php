<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Comment;


class PostPolicy
{
    use HandlesAuthorization;


    public function commentauthorization(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id;
    }
}
