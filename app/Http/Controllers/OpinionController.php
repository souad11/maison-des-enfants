<?php

namespace App\Http\Controllers;

use App\Models\Opinion;
use App\Models\Tutor;
use Illuminate\Support\Facades\Auth; // Importation correcte de Auth

use Illuminate\Http\Request;

class OpinionController extends Controller
{
   /**
     * Afficher la liste des opinions du tuteur connecté.
     */
    public function index()
    {
        // Récupère l'utilisateur connecté
        $user = Auth::user();
    
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

       // dd($tutorId);
        Opinion::create([
            'tutor_id' => $tutorId,
            'texte' => $request->input('texte'),
        ]);
    

        return redirect()->route('opinions.index')->with('success', 'Opinion créée avec succès.');
    }

    /**
     * Afficher une opinion spécifique.
     */
    public function show(Opinion $opinion)
    {

        return view('opinions.show', compact('opinion'));
    }

    /**
     * Afficher le formulaire pour éditer une opinion.
     */
    public function edit(Opinion $opinion)
    {

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
        $opinion->delete();

        return redirect()->route('opinions.index')->with('success', 'Opinion supprimée avec succès.');
    }
}


