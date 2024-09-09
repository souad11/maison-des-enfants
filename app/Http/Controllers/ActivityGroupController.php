<?php 

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityGroup;
use App\Models\Educator;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ActivityGroupController extends Controller
{
    /**
     * Affiche la liste des associations Activité-Groupe.
     */
    public function index()
    {
        Gate::authorize('viewAny', ActivityGroup::class);

        // Récupérer toutes les associations entre les activités et les groupes
        $activityGroups = ActivityGroup::with(['activity', 'group', 'educator.user'])->get();

        return view('activity_groups.index', compact('activityGroups'));
    }

    public function templateIndex()
    {
        $today = Carbon::today();
        $activities = ActivityGroup::with(['activity', 'group'])
            ->join('activities', 'activity_groups.activity_id', '=', 'activities.id')
            ->join('groups', 'activity_groups.group_id', '=', 'groups.id')
            ->whereDate('activities.start_date', '>=', $today)
            ->select('activity_groups.*', 'activities.start_date', 'groups.title as group_name')
            ->get();



            //dd($activities);
        // $activities = Activity::all();
        return view('activities.template', compact('activities'));
    }


//     public function index()
// {
//     // Vérifier si l'utilisateur est un éducateur
//     if (auth()->user()->role === 'educator') {
//         // Récupérer les groupes d'activités gérés par l'éducateur connecté
//         $activityGroups = ActivityGroup::with(['activity', 'group', 'educator.user'])
//                                        ->where('educator_id', auth()->user()->educator->id)
//                                        ->get();
//     } else {
//         // Récupérer toutes les associations entre les activités et les groupes (pour les administrateurs ou autres)
//         $activityGroups = ActivityGroup::with(['activity', 'group', 'educator.user'])->get();
//     }

//     return view('activity_groups.index', compact('activityGroups'));
// }


    public function showEducator() 
    {
        // Autorisation basée sur la policy
        Gate::authorize('viewForEducator', ActivityGroup::class);

        // Récupérer les groupes d'activités gérés par l'éducateur connecté
        $activityGroups = ActivityGroup::with(['activity', 'group', 'educator.user'])
                                    ->where('educator_id', auth()->user()->educator->id)
                                    ->get();

        return view('activity_groups.showEducator', compact('activityGroups'));
    }


    /**
     * Affiche le formulaire de création d'une nouvelle association Activité-Groupe.
     */
    public function create( )
    {
        Gate::authorize('create', ActivityGroup::class);

        $activities = Activity::all();
        $groups = Group::all();
        $educators = Educator::with('user')->get(); // Récupérer tous les éducateurs avec leurs informations utilisateur

        return view('activity_groups.create', compact('activities', 'groups', 'educators'));
    }

    /**
     * Stocke une nouvelle association Activité-Groupe.
     */
    public function store(Request $request)
    {
        $request->validate([
            'activity_id' => 'required|exists:activities,id',
            'group_id' => 'required|exists:groups,id',
            'educator_id' => 'required|exists:educators,id',
            'capacity' => 'required|integer|min:1',
            'available_space' => 'required|integer|min:0|max:' . $request->input('capacity'),
        ]);

        ActivityGroup::create([
            'activity_id' => $request->activity_id,
            'group_id' => $request->group_id,
            'educator_id' => $request->educator_id,
            'capacity' => $request->capacity,
            'available_space' => $request->available_space,
        ]);

        return redirect()->route('activity_groups.index')->with('success', 'Association créée avec succès.');
    }


    public function showParticipants($activityGroupId)
    {
        Gate::authorize('viewForEducator', ActivityGroup::class);

        // Chargement de l'ActivityGroup avec les registrations et les enfants associés
        $activityGroup = ActivityGroup::with(['registrations.child'])->find($activityGroupId);
    
        // Extraction des enfants à partir des registrations (inscriptions)
        $children = $activityGroup->registrations->map(function ($registration) {
            return $registration->child;
        });
    
        // Retourner la vue avec la liste des enfants
        return view('activity_groups.participants', ['children' => $children]);
    }
    
    public function edit($id)
    {
        // Récupérer l'association ActivityGroup par son ID
        $activityGroup = ActivityGroup::findOrFail($id);

        Gate::authorize('update', $activityGroup);

        // Récupérer les activités, groupes et éducateurs pour remplir le formulaire d'édition
        $activities = Activity::all();
        $groups = Group::all();
        $educators = Educator::with('user')->get();

        // Retourner la vue d'édition avec les données nécessaires
        return view('activity_groups.edit', compact('activityGroup', 'activities', 'groups', 'educators'));
    }

    public function update(Request $request, $id)
    {
        // Récupérer l'association ActivityGroup par son ID
        $activityGroup = ActivityGroup::findOrFail($id);

        
        Gate::authorize('update', $activityGroup);

        // Valider les données du formulaire
        $request->validate([
            'activity_id' => 'required|exists:activities,id',
            'group_id' => 'required|exists:groups,id',
            'educator_id' => 'required|exists:educators,id',
            'capacity' => 'required|integer|min:1',
            'available_space' => 'required|integer|min:0|max:' . $request->input('capacity'),
        ]);

        // Mettre à jour l'association ActivityGroup
        $activityGroup->update([
            'activity_id' => $request->activity_id,
            'group_id' => $request->group_id,
            'educator_id' => $request->educator_id,
            'capacity' => $request->capacity,
            'available_space' => $request->available_space,
        ]);

        // Rediriger vers la liste des associations avec un message de succès
        return redirect()->route('activity_groups.index')->with('success', 'Association mise à jour avec succès.');
    }
        public function destroy($id)
    {
        // Récupérer l'association ActivityGroup par son ID
        $activityGroup = ActivityGroup::findOrFail($id);

        // Vérifier l'autorisation pour supprimer cette association
        Gate::authorize('delete', $activityGroup);

        // Supprimer l'association
        $activityGroup->delete();

        // Rediriger vers la liste des associations avec un message de succès
        return redirect()->route('activity_groups.index')->with('success', 'Association supprimée avec succès.');
    }



}
