<?php 

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Afficher la liste des événements.
     */
    public function index()
    {
        $events = Event::where('event_date', '>', Carbon::now())
                        ->orderBy('event_date', 'asc')
                        ->take(3)
                        ->get();

        return view('dashboard', compact('events'));
    }

    public function template()
{
    $upcomingEvents = Event::where('event_date', '>', Carbon::now())
                            ->orderBy('event_date', 'asc')
                            ->take(3)
                            ->get();

    return view('home', compact('upcomingEvents'));
}
    /**
     * Afficher le formulaire pour créer un nouvel événement.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Enregistrer un nouvel événement dans la base de données.
     */
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        // Gestion du téléchargement de la photo
        if ($request->hasFile('photo')) {
            $imageName = time().'.'.$request->photo->extension();
            $request->photo->storeAs('public/events', $imageName);
            $data['photo'] = $imageName;
        }

        // Créer l'événement
        Event::create($data);

        return redirect()->route('events.index')->with('success', 'Événement créé avec succès.');
    }

    /**
     * Afficher un événement spécifique.
     */
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    /**
     * Afficher le formulaire pour modifier un événement.
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Mettre à jour un événement dans la base de données.
     */
    public function update(Request $request, Event $event)
    {
        // Validation des données
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        // Gestion du téléchargement de la photo
        if ($request->hasFile('photo')) {
            // Supprimer l'ancienne photo si elle existe
            if ($event->photo && \Storage::exists('public/events/' . $event->photo)) {
                \Storage::delete('public/events/' . $event->photo);
            }

            $imageName = time().'.'.$request->photo->extension();
            $request->photo->storeAs('public/events', $imageName);
            $data['photo'] = $imageName;
        }

        // Mettre à jour l'événement
        $event->update($data);

        return redirect()->route('events.index')->with('success', 'Événement mis à jour avec succès.');
    }

    /**
     * Supprimer un événement de la base de données.
     */
    public function destroy(Event $event)
    {
        // Supprimer l'image associée si elle existe
        if ($event->photo && \Storage::exists('public/events/' . $event->photo)) {
            \Storage::delete('public/events/' . $event->photo);
        }

        // Supprimer l'événement
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Événement supprimé avec succès.');
    }
}
