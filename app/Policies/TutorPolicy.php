<?php

namespace App\Policies;

use App\Models\Tutor;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TutorPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === 'admin';
    }

//     /**
//      * Determine whether the user can view the model.
//      */
//     public function view(User $user, Tutor $tutor): bool
//     {
//         //
//     }

//     /**
//      * Determine whether the user can create models.
//      */
//     public function create(User $user): bool
//     {
//         //
//     }

     /**
     * Vérifie si l'utilisateur peut mettre à jour un tuteur.
     */
    public function update(User $user, Tutor $tutor)
    {
        // Seul un utilisateur avec un rôle admin peut mettre à jour un tuteur
        return $user->role === 'admin';
    }

/**
     * Vérifie si l'utilisateur peut supprimer un tuteur.
     */
    public function delete(User $user, Tutor $tutor)
    {
        // Seul un utilisateur avec un rôle admin peut supprimer un tuteur
        return $user->role === 'admin';
    }

//     /**
//      * Determine whether the user can restore the model.
//      */
//     public function restore(User $user, Tutor $tutor): bool
//     {
//         //
//     }

//     /**
//      * Determine whether the user can permanently delete the model.
//      */
//     public function forceDelete(User $user, Tutor $tutor): bool
//     {
//         //
//     }
 }
