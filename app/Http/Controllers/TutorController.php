<?php

namespace App\Http\Controllers;

use App\Models\Tutor;
use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TutorController extends Controller
{
    /**
     * Montrer le formulaire pour ajouter un enfant.
     */
    public function showAddChildForm()
    {
        return view('tutors.create_child');
    }

    /**
     * Enregistrer un nouvel enfant.
     */
    public function storeChild(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'birthday' => 'required|date',
            'gender' => 'required|in:male,female',
        ]);

        // Associer l'enfant au tuteur connecté
        $tutor = Auth::user()->tutor;

        // Créer et enregistrer le nouvel enfant
        $child = new Child([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'tutor_id' => $tutor->id,
        ]);

        $child->save();

        return redirect()->route('tutor.children')->with('success', 'Enfant ajouté avec succès.');
    }

    public function showChildren()
    {
        // Récupérez l'ID de l'utilisateur connecté
        $user = Auth::user();

        // Vérifiez que l'utilisateur est bien un tuteur
        $tutor = $user->tutor;
        if (!$tutor) {
            return redirect()->route('profile.index')->withErrors('L\'utilisateur n\'est pas un tuteur.');
        }

        // Récupérez les enfants du tuteur
        $children = $tutor->children;

        return view('tutors.children', compact('children'));
    }


    public function destroy(Child $child)
    {
        // Obtenir l'utilisateur connecté et son profil de tuteur
        $user = Auth::user();
        $tutor = $user->tutor;
    
        // Vérifier que l'enfant appartient bien au tuteur connecté
        if ($child->tutor_id !== $tutor->id) {
            return back()->withErrors('Vous n\'avez pas le droit de supprimer cet enfant.');
        }
    
        // Suppression de l'enfant
        $child->delete();
    
        // Redirection avec un message de succès
        return back()->with('status', 'Enfant supprimé avec succès.');
    }
    
    public function showChildrenFeedbacks()
    {
        // Obtenir le tuteur connecté
        $tutor = Auth::user()->tutor;
    
        // Vérifier que l'utilisateur est bien un tuteur
        if (!$tutor) {
            return redirect()->route('profile.index')->withErrors('L\'utilisateur n\'est pas un tuteur.');
        }
    
        // Récupérer les enfants du tuteur avec leurs feedbacks
        $children = $tutor->children()->with('feedbacks.activityGroup.activity', 'feedbacks.activityGroup.group')->get();
    
        return view('tutors.children_feedbacks', compact('children'));
    }

    public function showChildrenSchedules()
{
    // Obtenir le tuteur connecté
    $tutor = Auth::user()->tutor;

    // Vérifier que l'utilisateur est bien un tuteur
    if (!$tutor) {
        return redirect()->route('profile.index')->withErrors('L\'utilisateur n\'est pas un tuteur.');
    }

    // Récupérer les enfants du tuteur avec les plannings des groupes d'activités
    $children = $tutor->children()->with('registrations.activityGroup.schedule')->get();

    //dd($children);



    return view('tutors.children_schedules', compact('children'));
}

public function showChildrenRegistrations()
{
    // Obtenir le tuteur connecté
    $tutor = Auth::user()->tutor;

    // Vérifier que l'utilisateur est bien un tuteur
    if (!$tutor) {
        return redirect()->route('profile.index')->withErrors('L\'utilisateur n\'est pas un tuteur.');
    }

    // Récupérer les enfants du tuteur avec les plannings des groupes d'activités
    $children = $tutor->children()->with('registrations.activityGroup')->get();

    //dd($children);



    return view('tutors.children_registrations', compact('children'));
}


}
