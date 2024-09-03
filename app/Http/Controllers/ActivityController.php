<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Models\ActivityGroup;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Activity::class);

        $activities = Activity::all();
        return view('activities.index', compact('activities'));
    }

    /**
     * Display the activities for the public template.
     */
    // public function templateIndex()
    // {
    //     $activities = Activity::all();
    //     return view('activities.template', compact('activities'));
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Activity::class);

        $prices = Price::all(); 
        return view('activities.create', compact('prices'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Activity::class);

        $request->validate([
            'price_id' => 'required|exists:prices,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string|in:annuel,hebdomadaire', // Validation du champ type
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
        $activity = Activity::findOrFail($id);

        Gate::authorize('view', $activity);

        return view('activities.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $activity = Activity::findOrFail($id);

        Gate::authorize('update', $activity);

        $prices = Price::all();
        return view('activities.edit', compact('activity', 'prices'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $activity = Activity::findOrFail($id);

        Gate::authorize('update', $activity);

        $request->validate([
            'price_id' => 'required|exists:prices,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string|in:annuel,hebdomadaire', // Validation du champ type
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $activity->update($request->all());

        return redirect()->route('activities.index')->with('success', 'Activité mise à jour avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $activity = Activity::findOrFail($id);

        Gate::authorize('delete', $activity);

        $activity->delete();

        return redirect()->route('activities.index')->with('success', 'Activité supprimée avec succès!');
    }


        public function filterActivities(Request $request)
    {
        $filter = $request->input('filter');

        $activitiesQuery = ActivityGroup::with('activity', 'group');

        // Filtrer par type d'activité
        if ($filter) {
            $activitiesQuery->whereHas('activity', function($query) use ($filter) {
                $query->where('type', $filter);
            });
        }

        $activities = $activitiesQuery->get();

        return view('activities.template', compact('activities'));
    }
    
}
