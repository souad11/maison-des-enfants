<?php

namespace App\Http\Controllers;

use App\Models\Tutor;
use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TutorController extends Controller
{
    /**
     * Afficher le formulaire pour ajouter un enfant.
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

    /**
     * Afficher les enfants d'un tuteur connecté.
     */
    public function showChildren()
    {
        // Récupérer le tuteur connecté
        $user = Auth::user();
        $tutor = $user->tutor;

        if (!$tutor) {
            return redirect()->route('profile.index')->withErrors('L\'utilisateur n\'est pas un tuteur.');
        }

        // Récupérer les enfants du tuteur
        $children = $tutor->children;

        return view('tutors.children', compact('children'));
    }

    /**
     * Supprimer un enfant.
     */
    public function destroy(Child $child)
    {
        // Obtenir le tuteur connecté
        $tutor = Auth::user()->tutor;

        // Vérifier que l'enfant appartient bien au tuteur connecté
        if ($child->tutor_id !== $tutor->id) {
            return back()->withErrors('Vous n\'avez pas le droit de supprimer cet enfant.');
        }

        // Supprimer l'enfant
        $child->delete();

        return back()->with('status', 'Enfant supprimé avec succès.');
    }

    /**
     * Afficher les feedbacks des enfants.
     */
    public function showChildrenFeedbacks(Request $request)
    {
        // Obtenir le tuteur connecté
        $tutor = Auth::user()->tutor;

        if (!$tutor) {
            return redirect()->route('profile.index')->withErrors('L\'utilisateur n\'est pas un tuteur.');
        }

        // Récupérer les enfants du tuteur avec leurs feedbacks
        $children = $tutor->children()
            ->with(['feedbacks' => function($query) {
                $query->orderBy('created_at', 'desc');
            }, 'feedbacks.activityGroup.activity', 'feedbacks.activityGroup.group'])
            ->get();

        // Filtrer les enfants si un enfant spécifique est sélectionné
        $selectedChild = $request->get('child_id');
        if ($selectedChild) {
            $children = $children->where('id', $selectedChild);
        }

        return view('tutors.children_feedbacks', compact('children', 'selectedChild'));
    }

    /**
     * Afficher les plannings des enfants.
     */
    public function showChildrenSchedules()
    {
        // Obtenir le tuteur connecté
        $tutor = Auth::user()->tutor;

        if (!$tutor) {
            return redirect()->route('profile.index')->withErrors('L\'utilisateur n\'est pas un tuteur.');
        }

        // Récupérer les enfants du tuteur avec les plannings des groupes d'activités
        $children = $tutor->children()->with('registrations.activityGroup.schedule')->get();

        return view('tutors.children_schedules', compact('children'));
    }

    /**
     * Afficher les inscriptions des enfants.
     */
    public function showChildrenRegistrations()
    {
        // Obtenir le tuteur connecté
        $tutor = Auth::user()->tutor;

        if (!$tutor) {
            return redirect()->route('profile.index')->withErrors('L\'utilisateur n\'est pas un tuteur.');
        }

        // Récupérer les enfants du tuteur avec leurs inscriptions
        $children = $tutor->children()->with('registrations.activityGroup')->get();

        return view('tutors.children_registrations', compact('children'));
    }

    /**
     * Afficher la liste des tuteurs et leurs enfants pour l'administrateur.
     */
    public function showTutorsWithChildren(Request $request)
    {
        Gate::authorize('viewAny', Tutor::class);

        // Récupérer le terme de recherche
        $search = $request->input('search');

        // Récupérer les tuteurs et leurs enfants avec une option de recherche
        $tutors = Tutor::with('children')
            ->whereHas('user', function($query) use ($search) {
                if ($search) {
                    $query->where('firstname', 'like', '%' . $search . '%')
                        ->orWhere('lastname', 'like', '%' . $search . '%');
                }
            })
            ->orWhereHas('children', function($query) use ($search) {
                if ($search) {
                    $query->where('firstname', 'like', '%' . $search . '%')
                        ->orWhere('lastname', 'like', '%' . $search . '%');
                }
            })
            ->get();

        return view('tutors.admin', compact('tutors', 'search'));
    }

    /**
     * Modifier un tuteur.
     */
    public function edit($id)
    {
        Gate::authorize('update', Tutor::class);

        $tutor = Tutor::findOrFail($id);
        return view('tutors.edit', compact('tutor'));
    }

    /**
     * Mettre à jour un tuteur.
     */
    public function update(Request $request, $id)
    {
        Gate::authorize('update', Tutor::class);

        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:10',
            'emergency_contact' => 'nullable|string|max:20',
        ]);

        $tutor = Tutor::findOrFail($id);
        $tutor->user->update([
            'firstname' => $validatedData['firstname'],
            'lastname' => $validatedData['lastname'],
            'email' => $validatedData['email'],
        ]);

        $tutor->update([
            'phone_number' => $validatedData['phone_number'],
            'address' => $validatedData['address'],
            'postal_code' => $validatedData['postal_code'],
            'emergency_contact' => $validatedData['emergency_contact'],
        ]);

        return redirect()->route('tutors.admin')->with('success', 'Tuteur mis à jour avec succès.');
    }
    public function show($id)
{
    $tutor = Tutor::findOrFail($id);
    return view('tutors.show', compact('tutor'));
}

    /**
     * Supprimer un tuteur.
     */
    public function destroyTutor($id)
    {
        Gate::authorize('delete', Tutor::class);

        $tutor = Tutor::findOrFail($id);
        $tutor->user->delete(); // Supprimer également l'utilisateur associé
        $tutor->delete();

        return redirect()->route('tutors.admin')->with('success', 'Tuteur supprimé avec succès.');
    }
}
