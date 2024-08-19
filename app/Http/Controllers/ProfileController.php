<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    /**
     * Afficher le formulaire pour modifier le profil de l'utilisateur connecté.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }


        /**
     * Afficher le profil de l'utilisateur connecté.
     */
    public function index()
{
    $user = Auth::user();
    $children = collect(); // Initialisez une collection vide pour les enfants

    if ($user->role == 'tutor' && isset($user->tutor)) {
        $children = $user->tutor->children; // Charge les enfants si l'utilisateur est un tuteur
    }

    return view('profile.index', compact('user', 'children'));
}


    public function update(Request $request)
    {
        // Validation de base pour tous les utilisateurs
        $rules = [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
        ];
    
        // Ajouter la validation pour l'adresse et le code postal si l'utilisateur est un tuteur
        if ($request->user()->role == 'tutor') {
            $rules['address'] = ['required', 'string', 'max:255'];
            $rules['postal_code'] = ['required', 'string', 'max:10'];
        }

         // Validation supplémentaire pour les éducateurs
        if ($request->user()->role == 'educator') {
            $rules['photo'] = ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048']; // 2MB Max
            $rules['description'] = ['nullable', 'string', 'max:1000'];
        }
    
        // Validation des champs
        $request->validate($rules);
    
        // Récupérer l'utilisateur connecté et mettre à jour les informations
        $user = $request->user();
        $user->fill($request->only('firstname', 'lastname', 'email'));
    
        // Réinitialiser l'email_verified_at si l'email a été modifié
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
    
        // Sauvegarder les modifications de l'utilisateur
        $user->save();
    
        // Si l'utilisateur est un tuteur, mettre à jour les informations dans la table tutors
        if ($request->user()->role == 'tutor') {
            $tutor = $user->tutor; // Assurez-vous que la relation tutor est bien définie dans le modèle User
            $tutor->address = $request->address;
            $tutor->postal_code = $request->postal_code;
            $tutor->save(); // Sauvegarde des informations du tuteur
        }

                // Gestion spécifique aux éducateurs
        if ($request->user()->role == 'educator') {
            // Traitement du fichier image
            if ($request->hasFile('photo')) {
                $filename = $request->file('photo')->store('photos', 'public');
                $user->educator->photo = $filename;
            }

            // Mise à jour de la description
            $user->educator->description = $request->description;
            $user->educator->save(); // Assurez-vous que la relation 'educator' est correctement définie dans le modèle User
        }
    
        // Rediriger vers le formulaire d'édition avec un message de confirmation
        return redirect()->route('profile.index')->with('status', 'profile-updated');
    }
    

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


    public function showChangePasswordForm()
    {
        return view('profile.password');
    }

    public function changePassword(Request $request)
    {
        // Validation des entrées du formulaire
        $request->validate([
            'current_password' => 'required',  // Vérifier que le champ n'est pas vide
            'new_password' => 'required|string|min:8|confirmed',  // Vérifier la longueur et la confirmation
        ]);
    
        $user = Auth::user();  // Récupération de l'utilisateur authentifié
    
        // Vérification que le mot de passe actuel est correct
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
        }
    
        // Mise à jour du mot de passe
        $user->password = Hash::make($request->new_password);
        $user->save();
    
        // Redirection avec un message de succès
        return redirect()->route('profile.password.form')->with('success', 'Mot de passe modifié avec succès.');
    }
    
}
