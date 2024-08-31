<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the groups.
     */
    public function index()
    {
        // Chargez tous les groupes
        $groups = Group::all();
        return view('groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new group.
     */
    public function create()
    {
        return view('groups.create');
    }

    /**
     * Store a newly created group in storage.
     */
    public function store(Request $request)
    {
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
        return view('groups.show', compact('group'));
    }

    /**
     * Show the form for editing the specified group.
     */
    public function edit($id)
    {
        $group = Group::findOrFail($id);
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
        $group->delete();

        return redirect()->route('groups.index')->with('success', 'Groupe supprimé avec succès.');
    }
}
