<?php

namespace App\Policies;

use App\Models\Discussion;
use App\Models\User;

class DiscussionPolicy
{
    public function update(User $user, Discussion $discussion)
    {
        // Allow the owner or an admin to update the discussion
        return $user->id === $discussion->user_id || $user->role === 'admin';
    }

    public function delete(User $user, Discussion $discussion)
    {
        // Allow the owner or an admin to delete the discussion
        return $user->id === $discussion->user_id || $user->role === 'admin';
    }
}
