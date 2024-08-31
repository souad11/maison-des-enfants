<?php

namespace App\Http\Controllers;

use App\Mail\EducatorWelcomeMail;
use App\Models\ActivityGroup;
use App\Models\Educator;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class EducatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        Gate::authorize('viewAny', Educator::class);

        //$educators = Educator::all();
        $educators = Educator::with('user')->get();

        return view('educators.index', compact('educators'));
    }

    public function templateIndex()
    {
        //$educators = Educator::all();
        $educators = Educator::with('user')->get();

        return view('educators.template', compact('educators'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Educator::class);

        return view('educators.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            Gate::authorize('create', Educator::class);

            $validatedData = $request->validate([
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'langue' => 'required|string|max:2',
            ]);

            $password = Str::random(10);  // Générer un mot de passe aléatoire

            // Générer un login à partir des prénoms et noms
            $login = strtolower($validatedData['firstname'][0]) . strtolower($validatedData['lastname']);

            // Créer le nouvel utilisateur
            $user = new User([
                'firstname' => $validatedData['firstname'],
                'lastname' => $validatedData['lastname'],
                'email' => $validatedData['email'],
                'password' => Hash::make($password),
                'login' => $login,
                'role' => 'educator',
                
            ]);

            $user->save();

            // Créer l'éducateur associé
            $educator = new Educator([
                'user_id' => $user->id,
            ]);
            $educator->save();

            // Envoyer l'email de bienvenue
            Mail::to($user->email)->send(new EducatorWelcomeMail($user, $password));

            // Rediriger vers une page avec un message de succès
            return redirect()->route('educators.index')->with('success', 'Éducateur ajouté avec succès et un email a 
            été envoyé avec les détails du compte.');
        } catch (\Exception $e) {
            // En cas d'erreur, rediriger vers une page ou retourner une réponse avec un message d'erreur
            
            return redirect()->route('educators.create')->with('error', 'Erreur lors de l\'ajout de l\'éducateur: ');
        }
    }

 /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $educator = Educator::with('user')->findOrFail($id);

        Gate::authorize('view', $educator);

        return view('educators.show', compact('educator'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $educator = Educator::findOrFail($id);
        Gate::authorize('delete', $educator);

        $educator->delete();

        return redirect()->route('educators.index')->with('success', 'Éducateur supprimé avec succès!');
    }
}
