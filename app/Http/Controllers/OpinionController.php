<?php

namespace App\Http\Controllers;

use App\Mail\OpinionStatusMail;
use App\Models\Opinion;
use App\Models\Tutor;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth; // Importation correcte de Auth

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate as FacadesGate;
use Illuminate\Support\Facades\Mail;

class OpinionController extends Controller
{
   /**
     * Afficher la liste des opinions du tuteur connecté.
     */
    public function index()
    {
        // Récupère l'utilisateur connecté
        $user = Auth::user();

        Gate::authorize('viewAny', Opinion::class);

    
        // Assure-toi que l'utilisateur a un tutor associé
        if (!$user->tutor) {
            // Gère le cas où l'utilisateur n'a pas de tutor associé
            return redirect()->route('home')->with('error', 'Vous n\'avez pas de profil de tuteur associé.');
        }
    
        // Récupère l'ID du tutor
        $tutorId = $user->tutor->id;
    
        // Récupère les opinions associées à ce tutor
        $opinions = Opinion::where('tutor_id', $tutorId)->orderBy('created_at', 'desc')->get();
    
        // Retourne la vue avec les opinions
        return view('opinions.index', compact('opinions'));
    }
    

    /**
     * Afficher le formulaire pour créer une nouvelle opinion.
     */
    public function create()
    {
        Gate::authorize('create', Opinion::class);

        return view('opinions.create');
    }

    /**
     * Enregistrer une nouvelle opinion.
     */
    public function store(Request $request)
    {
        $request->validate([
            'texte' => 'required|string',
        ]);

        $tutorId = Auth::user()->tutor->id; 

        Gate::authorize('create', Opinion::class);

       // dd($tutorId);
        Opinion::create([
            'tutor_id' => $tutorId,
            'texte' => $request->input('texte'),
            'is_approved' => null, 
        ]);
    

        return redirect()->route('opinions.index')->with('success', 'Opinion créée avec succès.');
    }

    /**
     * Afficher une opinion spécifique.
     */
    public function show(Opinion $opinion)
    {

        Gate::authorize('view', $opinion);

        return view('opinions.show', compact('opinion'));
    }

    /**
     * Afficher le formulaire pour éditer une opinion.
     */
    public function edit(Opinion $opinion)
    {

        Gate::authorize('update', $opinion);

        return view('opinions.edit', compact('opinion'));
    }

    /**
     * Mettre à jour une opinion existante.
     */
    public function update(Request $request, Opinion $opinion)
    {

        $request->validate([
            'texte' => 'required|string',
        ]);

        Gate::authorize('update', $opinion);

        $opinion->update([
            'texte' => $request->input('texte'),
        ]);

        return redirect()->route('opinions.index')->with('success', 'Opinion mise à jour avec succès.');
    }

    /**
     * Supprimer une opinion.
     */
    public function destroy(Opinion $opinion)
    {
        Gate::authorize('delete', $opinion);

        $opinion->delete();

        return redirect()->route('opinions.index')->with('success', 'Opinion supprimée avec succès.');
    }

    // public function indexAdmin()
    // {
    //     Gate::authorize('viewAdmin', Opinion::class);

    //     // Récupérer toutes les opinions
    //     $opinions = Opinion::orderBy('created_at', 'desc')->get();

    //     // Retourner la vue avec les avis
    //     return view('opinions.indexAdmin', compact('opinions'));
    // }

    public function indexAdmin(Request $request)
{
    Gate::authorize('viewAdmin', Opinion::class);

    // Récupérer le statut de filtre du formulaire (si soumis)
    $filterStatus = $request->input('status', 'all'); // Par défaut, afficher tous les avis

    // Construction de la requête de base
    $opinionsQuery = Opinion::orderBy('created_at', 'desc');

    // Appliquer un filtre basé sur le statut
    if ($filterStatus === 'approved') {
        $opinionsQuery->where('is_approved', true);
    } elseif ($filterStatus === 'rejected') {
        $opinionsQuery->where('is_approved', false);
    }

    // Exécuter la requête et récupérer les résultats
    $opinions = $opinionsQuery->get();

    // Retourner la vue avec les opinions filtrées et le statut sélectionné
    return view('opinions.indexAdmin', compact('opinions', 'filterStatus'));
}

    
    
    public function approve(Opinion $opinion)
    {

        Gate::authorize('approve', $opinion);

        $opinion->update(['is_approved' => true]);

       

        return redirect()->route('dashboard')->with('success', 'Opinion approuvée avec succès.');
    }

    public function reject(Opinion $opinion)
{
    Gate::authorize('reject', $opinion);

    // Mettre à jour le statut de l'opinion
    $opinion->update(['is_approved' => false]);

    
    $tutorEmail = $opinion->tutor->user->email;

    $tutorName = $opinion->tutor->user->firstname;

    //dd($tutor);

    
    // Envoyer l'e-mail
    Mail::to($tutorEmail)->send(new OpinionStatusMail($opinion, $tutorEmail, $tutorName));

    return redirect()->route('dashboard')->with('success', 'Opinion rejetée.');
}
}


