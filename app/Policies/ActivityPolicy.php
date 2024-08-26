<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Activity;

class ActivityPolicy
{
    /**
     * Determine whether the user can view any activities.
     */
    public function viewAny(User $user)
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can view the activity.
     */
    public function view(User $user, Activity $activity)
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can create activities.
     */
    public function create(User $user)
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can update the activity.
     */
    public function update(User $user, Activity $activity)
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the activity.
     */
    public function delete(User $user, Activity $activity)
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore the activity.
     */
    public function restore(User $user, Activity $activity)
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the activity.
     */
    public function forceDelete(User $user, Activity $activity)
    {
        return $user->role === 'admin';
    }
}
