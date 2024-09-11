<?php 

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Notifications\NewMessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // Afficher les messages entre l'utilisateur connecté et l'utilisateur cible
    public function index($userId)
    {
        // Vérifier si l'utilisateur est connecté (non nécessaire si les routes sont protégées par 'auth')
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('Vous devez être connecté pour voir cette page.');
        }

        // Récupérer le destinataire (l'utilisateur avec qui on communique)
        $receiver = User::findOrFail($userId);
        
        // Récupérer l'historique des messages entre l'utilisateur connecté et le destinataire
        $messages = Message::where(function($query) use ($userId) {
            $query->where('sender_id', Auth::id())
                  ->where('receiver_id', $userId);
        })->orWhere(function($query) use ($userId) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', Auth::id());
        })->orderBy('created_at', 'asc')->get();

        // Retourner la vue avec l'historique des messages et le destinataire
        return view('message.index', compact('messages', 'receiver'));
    }

    public function store(Request $request, $userId)
    {
        $request->validate([
            'body' => 'required|string',
        ]);

        // Créer un nouveau message
        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $userId,
            'body' => $request->input('body'),
        ]);

        // Charger explicitement la relation 'sender'
        $message->load('sender');

        // Envoyer une notification au destinataire
        $receiver = User::findOrFail($userId);
        $receiver->notify(new NewMessageNotification($message));

        return redirect()->route('message.index', $userId);
    }

    public function createConversation()
    {
        // Vérifier si l'utilisateur est connecté (non nécessaire si protégé par 'auth')
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('Vous devez être connecté pour démarrer une conversation.');
        }

        // Récupérer l'utilisateur connecté
        $currentUser = Auth::user();

        // Logique pour filtrer les utilisateurs par rôle
        if ($currentUser->role == 'tutor') {
            $users = User::whereIn('role', ['educator', 'admin'])
                         ->where('id', '!=', $currentUser->id)->get();
        } elseif ($currentUser->role == 'educator') {
            $users = User::whereIn('role', ['tutor', 'admin'])
                         ->where('id', '!=', $currentUser->id)->get();
        } elseif ($currentUser->role == 'admin') {
            $users = User::where('id', '!=', $currentUser->id)->get();
        } else {
            $users = collect();
        }

        return view('message.create_conversation', compact('users'));
    }

    public function markAsRead($id)
    {
        // Récupérer la notification par son ID
        $notification = auth()->user()->notifications()->find($id);

        // Si la notification existe, la marquer comme lue
        if ($notification) {
            $notification->markAsRead();
            return response()->json(['status' => 'Notification marked as read']);
        }

        return response()->json(['status' => 'Notification not found'], 404);
    }
}
