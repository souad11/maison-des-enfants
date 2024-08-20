<?php 

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityGroup;
use App\Models\Educator;
use App\Models\Group;
use Illuminate\Http\Request;

class ActivityGroupController extends Controller
{
    /**
     * Affiche la liste des associations Activité-Groupe.
     */
    public function index()
    {
        // Récupérer toutes les associations entre les activités et les groupes
        $activityGroups = ActivityGroup::with(['activity', 'group', 'educator.user'])->get();

        return view('activity_groups.index', compact('activityGroups'));
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
        // Vérifier si l'utilisateur est un éducateur
        if (auth()->user()->role === 'educator') {
        // Récupérer les groupes d'activités gérés par l'éducateur connecté
        $activityGroups = ActivityGroup::with(['activity', 'group', 'educator.user'])
                                       ->where('educator_id', auth()->user()->educator->id)
                                       ->get();
        }
        return view('activity_groups.showEducator', compact('activityGroups'));

    }

    /**
     * Affiche le formulaire de création d'une nouvelle association Activité-Groupe.
     */
    public function create()
    {
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
        ]);

        ActivityGroup::create([
            'activity_id' => $request->activity_id,
            'group_id' => $request->group_id,
            'educator_id' => $request->educator_id,
        ]);

        return redirect()->route('activity_groups.index')->with('success', 'Association créée avec succès.');
    }

    public function showParticipants($activityGroupId)
    {
        // Chargement de l'ActivityGroup avec les registrations et les enfants associés
        $activityGroup = ActivityGroup::with(['registrations.child'])->find($activityGroupId);
    
        // Extraction des enfants à partir des registrations
        $children = $activityGroup->registrations->map(function ($registration) {
            return $registration->child;
        });
    
        // Retourner la vue avec la liste des enfants
        return view('activity_groups.participants', ['children' => $children]);
    }
    
}
