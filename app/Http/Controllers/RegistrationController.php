<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Child;
use App\Models\Group;
use App\Models\Registration;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    /**
     * Show the form for registering an activity.
     */
    public function register($id)
{
    // Vérifier si l'utilisateur connecté est un tuteur
    if (!auth()->user()->tutor) {
        // Si l'utilisateur n'est pas un tuteur, rediriger ou afficher un message
        abort(403, 'Seuls les tuteurs peuvent inscrire les enfants.');
    }

    $activity = Activity::findOrFail($id);
    $availableGroups = $activity->groups()->where('available_space', '>', 0)->get();
    $children = Child::where('tutor_id', auth()->user()->tutor->id)->get(); // Récupérer les enfants du tuteur connecté

    return view('activities.register', compact('activity', 'availableGroups', 'children'));
}

    

    /**
     * Store a newly registered activity.
     */


public function store(Request $request)
{

    $request->validate([
        'activity_id' => 'required|exists:activities,id',
        'child_id' => 'required|exists:children,id',
        'group_id' => 'required|exists:groups,id',
    ]);

    $group = Group::findOrFail($request->group_id);
    $child = Child::findOrFail($request->child_id);

    // Vérifier si le groupe est complet
    if ($group->available_space <= 0) {
        return back()->withErrors(['group_id' => 'Ce groupe est complet.']);
    }

    // Calculer l'âge de l'enfant à partir de sa date de naissance
    $childAge = Carbon::parse($child->birthday)->age;

    // Vérifier si l'âge de l'enfant est approprié pour le groupe
    if ($childAge < $group->min_age || $childAge > $group->max_age) {
        return back()->withErrors(['child_id' => 'L\'âge de l\'enfant ne correspond pas à la tranche d\'âge du groupe sélectionné.']);
    }

    // Créer l'inscription
    $registration = Registration::create([
        'child_id' => $request->child_id,
        'activity_group_id' => $request->group_id,
        'status' => 'Pending', // Statut de l'inscription
    ]);

    // Réduire le nombre de places disponibles
    $group->available_space--;
    $group->save();

    //dd($registration, $group); // Affiche l'inscription et le groupe après mise à jour


    return redirect()->route('activities.template')->with('success', 'Inscription réussie.');
}

    
    // Méthodes pour gérer les paiements, afficher les inscriptions, etc., peuvent être ajoutées ici.
}
