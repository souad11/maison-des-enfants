<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Child;
use App\Models\ActivityGroup;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
   

    public function create(Request $request)
{

    Gate::authorize('create', Feedback::class);

    $childId = $request->input('child_id');
    $activityGroupId = $request->input('activity_group_id');

    $child = Child::findOrFail($childId);
    $activityGroup = ActivityGroup::findOrFail($activityGroupId);

    return view('feedbacks.create', compact('child', 'activityGroup'));
}


public function children($activityGroupId)
{
    // Récupérer le groupe d'activités
    $activityGroup = ActivityGroup::findOrFail($activityGroupId);

    // Récupérer les enfants inscrits dans ce groupe d'activités
    $children = Child::whereHas('registrations', function($query) use ($activityGroupId) {
        $query->where('activity_group_id', $activityGroupId);
    })->get();

    return view('feedbacks.children', compact('activityGroup', 'children'));
}

    

// Enregistrer un nouveau feedback
public function store(Request $request)
{
    // Vérification des autorisations
    Gate::authorize('create', Feedback::class);

    // Validation des données
    $request->validate([
        'child_id' => 'required|exists:children,id',
        'activity_group_id' => 'required|exists:activity_groups,id',
        'content' => 'required|string',
    ]);

    // Créer le feedback
    Feedback::create($request->all());

    // Récupérer l'activity_group_id pour la redirection
    $activityGroupId = $request->input('activity_group_id');

    // Rediriger vers la route feedbacks.children avec l'activity_group_id
    return redirect()->route('feedbacks.children', ['activity_group_id' => $activityGroupId])
        ->with('success', 'Feedback créé avec succès.');
}


    // Afficher un feedback spécifique
    public function show($id)
    {
        $feedback = Feedback::with(['child', 'activityGroup'])->findOrFail($id);

        Gate::authorize('view', $feedback);

        return view('feedbacks.show', compact('feedback'));
    }

    // Afficher le formulaire d'édition d'un feedback existant
    public function edit($id)
    {
        $feedback = Feedback::findOrFail($id);

        Gate::authorize('update', $feedback);

        $children = Child::all();
        $activityGroups = ActivityGroup::all();
        return view('feedbacks.edit', compact('feedback', 'children', 'activityGroups'));
    }

// Mettre à jour un feedback existant
public function update(Request $request, $id)
{
    // Validation des champs
    $request->validate([
        'child_id' => 'required|exists:children,id',
        'activity_group_id' => 'required|exists:activity_groups,id',
        'content' => 'required|string',
    ]);

    // Trouver le feedback à mettre à jour
    $feedback = Feedback::findOrFail($id);

    // Vérification des autorisations
    Gate::authorize('update', $feedback);

    // Mettre à jour le feedback avec les nouvelles données
    $feedback->update($request->all());

    // Récupérer l'activity_group_id pour la redirection
    $activityGroupId = $request->input('activity_group_id');

    // Rediriger vers la route feedbacks.children avec l'activity_group_id
    return redirect()->route('feedbacks.children', ['activity_group_id' => $activityGroupId])
        ->with('success', 'Feedback mis à jour avec succès.');
}


// Supprimer un feedback existant
public function destroy($id)
{
    // Trouver le feedback à supprimer
    $feedback = Feedback::findOrFail($id);

    // Vérification des autorisations
    Gate::authorize('delete', $feedback);

    // Récupérer l'activity_group_id avant de supprimer le feedback
    $activityGroupId = $feedback->activityGroup->id;

    // Supprimer le feedback
    $feedback->delete();

    // Rediriger vers la route feedbacks.children avec l'activity_group_id
    return redirect()->route('feedbacks.children', ['activity_group_id' => $activityGroupId])
        ->with('success', 'Feedback supprimé avec succès.');
}


    
}
