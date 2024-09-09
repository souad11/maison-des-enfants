<?php

namespace App\Policies;

use App\Models\Opinion;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class OpinionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === 'tutor';

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Opinion $opinion): bool
    {
        return $user->role === 'tutor';

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'tutor';

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Opinion $opinion): bool
    {
        return $user->role === 'tutor';

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Opinion $opinion): bool
    {
        return $user->role === 'tutor';

    }

    // /**
    //  * Determine whether the user can restore the model.
    //  */
    // public function restore(User $user, Opinion $opinion): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete(User $user, Opinion $opinion): bool
    // {
    //     //
    // }

    public function approve(User $user): bool
    {
        // Autorise seulement les administrateurs à approuver des avis
        return $user->role === 'admin';
    }

    /**
     * Détermine si l'utilisateur peut rejeter un avis.
     */
    public function reject(User $user): bool
    {
        // Autorise seulement les administrateurs à rejeter des avis
        return $user->role === 'admin';
    }

    public function viewAdmin(User $user): bool
    {
        return $user->role === 'admin';
    }

}
