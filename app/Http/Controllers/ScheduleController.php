<?php 

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\ActivityGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Vérifier si l'utilisateur est un éducateur
        if (Auth::user()->role === 'educator') {
            // Récupérer les plannings des groupes d'activités gérés par l'éducateur connecté
            $schedules = Schedule::whereHas('activityGroup', function($query) {
                $query->where('educator_id', Auth::user()->educator->id);
            })->get();
        } else {
            // Récupérer tous les plannings pour les administrateurs
            $schedules = Schedule::all();
        }

        return view('schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
            // Récupérer les groupes d'activités gérés par l'éducateur connecté
    $activityGroups = ActivityGroup::where('educator_id', Auth::user()->educator->id)->get();

        return view('schedules.create', compact('activityGroups'));
    }

   


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'activity_group_id' => 'required|exists:activity_groups,id',
        'monday' => 'nullable|string|max:255',
        'tuesday' => 'nullable|string|max:255',
        'wednesday' => 'nullable|string|max:255',
        'thursday' => 'nullable|string|max:255',
        'friday' => 'nullable|string|max:255',
        'saturday' => 'nullable|string|max:255',
    ]);

    $activityGroup = ActivityGroup::findOrFail($request->activity_group_id);

    // Vérifier que l'utilisateur connecté est l'éducateur associé à ce groupe d'activités
    if (Auth::user()->role !== 'educator' || Auth::user()->educator->id !== $activityGroup->educator_id) {
        abort(403, 'Vous n\'êtes pas autorisé à créer un planning pour ce groupe d\'activités.');
    }

    Schedule::create([
        'activity_group_id' => $request->activity_group_id,
        'monday' => $request->monday,
        'tuesday' => $request->tuesday,
        'wednesday' => $request->wednesday,
        'thursday' => $request->thursday,
        'friday' => $request->friday,
        'saturday' => $request->saturday,
    ]);

    return redirect()->route('schedules.show', $request->activity_group_id)
                     ->with('success', 'Planning créé avec succès.');
}


    /**
     * Display the specified resource.
     */
    public function show($scheduleId)
    {
        $schedule = Schedule::with('activityGroup')->findOrFail($scheduleId);

        // Vérifier que l'utilisateur connecté est l'éducateur associé à ce planning ou un administrateur
        if (Auth::user()->role !== 'admin' && Auth::user()->educator->id !== $schedule->activityGroup->educator_id) {
            abort(403, 'Vous n\'êtes pas autorisé à voir ce planning.');
        }

        return view('schedules.show', compact('schedule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($scheduleId)
    {
        $schedule = Schedule::with('activityGroup')->findOrFail($scheduleId);

        // Vérifier que l'utilisateur connecté est l'éducateur associé à ce planning ou un administrateur
        if (Auth::user()->role !== 'admin' && Auth::user()->educator->id !== $schedule->activityGroup->educator_id) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier ce planning.');
        }

        return view('schedules.edit', compact('schedule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $scheduleId)
    {
        $schedule = Schedule::findOrFail($scheduleId);

        // Vérifier que l'utilisateur connecté est l'éducateur associé à ce planning ou un administrateur
        if (Auth::user()->role !== 'admin' && Auth::user()->educator->id !== $schedule->activityGroup->educator_id) {
            abort(403, 'Vous n\'êtes pas autorisé à mettre à jour ce planning.');
        }

        $request->validate([
            'monday' => 'nullable|string|max:255',
            'tuesday' => 'nullable|string|max:255',
            'wednesday' => 'nullable|string|max:255',
            'thursday' => 'nullable|string|max:255',
            'friday' => 'nullable|string|max:255',
            'saturday' => 'nullable|string|max:255',
        ]);

        $schedule->update($request->all());

        return redirect()->route('schedules.index')
                         ->with('success', 'Planning mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($scheduleId)
    {
        $schedule = Schedule::findOrFail($scheduleId);

        // Vérifier que l'utilisateur connecté est l'éducateur associé à ce planning ou un administrateur
        if (Auth::user()->role !== 'admin' && Auth::user()->educator->id !== $schedule->activityGroup->educator_id) {
            abort(403, 'Vous n\'êtes pas autorisé à supprimer ce planning.');
        }

        $schedule->delete();

        return redirect()->route('schedules.show', $schedule->activity_group_id)
                         ->with('success', 'Planning supprimé avec succès.');
    }
}
