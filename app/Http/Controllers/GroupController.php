<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class GroupController extends Controller
{
    /**
     * Display a listing of the groups.
     */
    public function index()
    {
        Gate::authorize('viewAny', Group::class);

        // Chargez tous les groupes
        $groups = Group::all();
        return view('groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new group.
     */
    public function create()
    {
        Gate::authorize('create', Group::class);

        return view('groups.create');
    }

    /**
     * Store a newly created group in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Group::class);

        // Validation des données de la requête
        $request->validate([
            'title' => 'required|string|max:255',
            'min_age' => 'required|integer',
            'max_age' => 'required|integer',
        ]);

        // Création du groupe
        Group::create($request->only([
            'title',
            'min_age',
            'max_age',
        ]));

        return redirect()->route('groups.index')->with('success', 'Groupe créé avec succès.');
    }

    /**
     * Display the specified group.
     */
    public function show($id)
    {
        $group = Group::findOrFail($id);
        Gate::authorize('view', $group);

        return view('groups.show', compact('group'));
    }

    /**
     * Show the form for editing the specified group.
     */
    public function edit($id)
    {
        $group = Group::findOrFail($id);
        Gate::authorize('update', $group);

        return view('groups.edit', compact('group'));
    }

    /**
     * Update the specified group in storage.
     */
    public function update(Request $request, $id)
    {
        // Validation des données de la requête
        $request->validate([
            'title' => 'required|string|max:255',
            'min_age' => 'required|integer',
            'max_age' => 'required|integer',
        ]);

        $group = Group::findOrFail($id);

        Gate::authorize('update', $group);


        // Mise à jour du groupe
        $group->update($request->only([
            'title',
            'min_age',
            'max_age',
        ]));

        return redirect()->route('groups.index')->with('success', 'Groupe mis à jour avec succès.');
    }

    /**
     * Remove the specified group from storage.
     */
    public function destroy($id)
    {
        $group = Group::findOrFail($id);
        Gate::authorize('delete', $group);

        $group->delete();

        return redirect()->route('groups.index')->with('success', 'Groupe supprimé avec succès.');
    }
}
