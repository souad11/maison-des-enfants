<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityResource;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $activities = Activity::with(['price',])->get();
        // return ActivityResource::collection($activities);

        //return ActivityResource::collection(Activity::all());

         // Récupère toutes les activités avec leurs groupes associés
        $activities = Activity::with('groups')
        ->where('start_date', '>', now()) // Optionnel: filtrer pour les activités futures
        ->orderBy('start_date') // Optionnel: trier par date de début
        ->get();

        return ActivityResource::collection($activities);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données de la requête
        $validated = $request->validate([
            'price_id' => 'required|exists:prices,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Création de l'activité
        $activity = Activity::create($validated);

        return new ActivityResource($activity);
    }


    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {

        return new ActivityResource($activity);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validation des données de la requête
        $validated = $request->validate([
            'price_id' => 'required|exists:prices,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Récupère l'activité à mettre à jour
        $activity = Activity::findOrFail($id);

        // Met à jour les informations de l'activité
        $activity->update($validated);


        return new ActivityResource($activity);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Récupère l'activité à supprimer
        $activity = Activity::findOrFail($id);

        // Supprime l'activité
        $activity->delete();

        return response()->json(['message' => 'Activity deleted successfully.'], 200);
    }

}
