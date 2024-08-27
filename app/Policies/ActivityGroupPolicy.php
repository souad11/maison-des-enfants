<?php 

namespace App\Policies;

use App\Models\ActivityGroup;
use App\Models\User;

class ActivityGroupPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Seul l'administrateur peut voir la liste des ActivityGroup
        return $user->role === 'admin';
    }

    public function viewForEducator(User $user)
    {
        // Vérifie si l'utilisateur est un éducateur
        return $user->role === 'educator';
    }



    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ActivityGroup $activityGroup): bool
    {
        // Seul l'administrateur peut voir un ActivityGroup spécifique
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Seul l'administrateur peut créer un ActivityGroup
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ActivityGroup $activityGroup): bool
    {
        // Seul l'administrateur peut mettre à jour un ActivityGroup
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ActivityGroup $activityGroup): bool
    {
        // Seul l'administrateur peut supprimer un ActivityGroup
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ActivityGroup $activityGroup): bool
    {
        // Seul l'administrateur peut restaurer un ActivityGroup
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ActivityGroup $activityGroup): bool
    {
        // Seul l'administrateur peut supprimer définitivement un ActivityGroup
        return $user->role === 'admin';
    }
}
