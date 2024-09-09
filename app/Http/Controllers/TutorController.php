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
            'birthday' => 'required|date|before:today|after:1900-01-01',
            'gender' => 'required|in:male,female',
        ], [
            'birthday.before' => 'La date de naissance doit être avant aujourd\'hui.',
            'birthday.after' => 'La date de naissance ne peut pas être avant 1900.',
        ]);
        

        // Obtenir le tuteur connecté
        $tutor = Auth::user()->tutor;

        // Vérifier si l'enfant existe déjà (même prénom, nom et date de naissance pour le même tuteur)
        $existingChild = Child::where('firstname', $request->firstname)
                            ->where('lastname', $request->lastname)
                            ->where('birthday', $request->birthday)
                            ->where('tutor_id', $tutor->id)
                            ->first();

        // Si l'enfant existe déjà, retourner une erreur
        if ($existingChild) {
            return redirect()->back()->withErrors('Cet enfant existe déjà dans votre liste.');
        }

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
    
    public function showChildrenFeedbacks(Request $request)
    {
        // Obtenir le tuteur connecté
        $tutor = Auth::user()->tutor;
    
        // Vérifier que l'utilisateur est bien un tuteur
        if (!$tutor) {
            return redirect()->route('profile.index')->withErrors('L\'utilisateur n\'est pas un tuteur.');
        }
    //Récupérer les enfants du tuteur avec leurs feedbacks
    //    $children = $tutor->children()->with('feedbacks.activityGroup.activity', 'feedbacks.activityGroup.group')->get();
    $children = $tutor->children()
    ->with(['feedbacks' => function($query) {
        $query->orderBy('created_at', 'desc'); // Trier par date de création décroissante
    }, 'feedbacks.activityGroup.activity', 'feedbacks.activityGroup.group'])
    ->get();

       //Filtrer les enfants si un enfant spécifique est sélectionné
    $selectedChild = $request->get('child_id');
    if ($selectedChild) {
        $children = $children->where('id', $selectedChild);
    }
    return view('tutors.children_feedbacks', compact('children', 'selectedChild'));
        
    
        // return view('tutors.children_feedbacks', compact('children'));
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
