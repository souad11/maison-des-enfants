<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Price;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (! Gate::allows('admin')) {
            abort(403, 'Unauthorized');
        }
        
        $activities = Activity::all();
        return view('activities.index', compact('activities'));
    }

    public function templateIndex()
    {

        $activities = Activity::all();
        return view('activities.template', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prices = Price::all(); 
        return view('activities.create', compact('prices'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'price_id' => 'required|exists:prices,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Activity::create($request->all());

        return redirect()->route('activities.index')->with('success', 'Activité créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Récupère l'activité par son ID
        $activity = Activity::findOrFail($id);

        // Récupère les groupes associés à cette activité
        $groups = $activity->groups;

        // Retourne la vue avec les groupes
        return view('activities.show', compact('activity', 'groups'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $activity = Activity::findOrFail($id);
        $prices = Price::all(); // Récupérer tous les prix disponibles
        return view('activities.edit', compact('activity', 'prices'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'price_id' => 'required|exists:prices,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $activity = Activity::findOrFail($id);
        $activity->update($request->all());
    
        return redirect()->route('activities.index')->with('success', 'Activité mise à jour avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();

        return redirect()->route('activities.index')->with('success', 'Activité supprimée avec succès!');
    }
}
