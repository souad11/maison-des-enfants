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
    public function index()
    {

        Gate::authorize('viewAny', Feedback::class);

        // Obtenir l'animateur connecté
        $educatorId = Auth::user()->educator->id;
    
        // Récupérer les feedbacks des groupes d'activités gérés par cet animateur
        $feedbacks = Feedback::whereHas('activityGroup', function($query) use ($educatorId) {
            $query->where('educator_id', $educatorId);
        })->with(['child', 'activityGroup'])->get();
    
        return view('feedbacks.index', compact('feedbacks'));
    }

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
        Gate::authorize('create', Feedback::class);


        $request->validate([
            'child_id' => 'required|exists:children,id',
            'activity_group_id' => 'required|exists:activity_groups,id',
            'content' => 'required|string',
        ]);

        Feedback::create($request->all());

        return redirect()->route('feedbacks.index')->with('success', 'Feedback created successfully.');
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
        

        $request->validate([
            'child_id' => 'required|exists:children,id',
            'activity_group_id' => 'required|exists:activity_groups,id',
            'content' => 'required|string',
        ]);

        $feedback = Feedback::findOrFail($id);

        Gate::authorize('update', $feedback);

        $feedback->update($request->all());

        return redirect()->route('feedbacks.index')->with('success', 'Feedback updated successfully.');
    }

    // Supprimer un feedback existant
    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);

        Gate::authorize('delete', $feedback);

        $feedback->delete();

        return redirect()->route('feedbacks.index')->with('success', 'Feedback deleted successfully.');
    }

    
}
