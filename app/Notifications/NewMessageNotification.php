<?php 

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewMessageNotification extends Notification
{
    use Queueable;

    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        $sender = User::find($this->message->sender_id);

    //dd($this->message->sender_id, $sender);
        // Charger explicitement l'expéditeur du message
        $sender = User::find($this->message->sender_id);  // S'assurer que l'expéditeur est récupéré

        return [
            'sender_id' => $this->message->sender_id,  // Assurez-vous que sender_id est bien inclus ici
            'sender_name' => $sender ? $sender->firstname : 'Utilisateur inconnu',  // Vérifiez également que sender_name est récupéré
            'message_body' => $this->message->body,
            'message_id' => $this->message->id,
        ];
    }
}
