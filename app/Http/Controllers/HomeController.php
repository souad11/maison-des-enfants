<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Opinion;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Récupérer les événements à venir
        $upcomingEvents = Event::where('event_date', '>', Carbon::now())
                                ->orderBy('event_date', 'asc')
                                ->take(3)
                                ->get();


        // Récupère uniquement les avis approuvés
        $parentOpinions = Opinion::where('is_approved', true)
        ->orderBy('created_at', 'desc')
        ->take(3) 
        ->get();

        // Passer les données à la vue home
        return view('home', compact('upcomingEvents', 'parentOpinions'));
    }

}
