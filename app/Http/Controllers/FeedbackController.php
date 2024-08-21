<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Child;
use App\Models\ActivityGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    // Afficher la liste des feedbacks
    public function index()
    {
        $feedbacks = Feedback::with(['child', 'activityGroup'])->get(); // Récupérer tous les feedbacks avec les relations
        return view('feedbacks.index', compact('feedbacks')); // Retourne une vue avec les feedbacks
    }

    public function create(Request $request)
{
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
        return view('feedbacks.show', compact('feedback'));
    }

    // Afficher le formulaire d'édition d'un feedback existant
    public function edit($id)
    {
        $feedback = Feedback::findOrFail($id);
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
        $feedback->update($request->all());

        return redirect()->route('feedbacks.index')->with('success', 'Feedback updated successfully.');
    }

    // Supprimer un feedback existant
    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return redirect()->route('feedbacks.index')->with('success', 'Feedback deleted successfully.');
    }

    
}
