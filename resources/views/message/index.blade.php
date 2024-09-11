@extends('adminlte::page')

@section('content')
<div class="container">

    <h1>Messages avec {{ $receiver->firstname }}</h1>

    <div class="card mt-4" id="messageContainer" style="max-height: 400px; overflow-y: auto;">
    <div class="card-body">
        @if($messages->isEmpty())
            <p>Aucun message pour le moment.</p>
        @else
            @foreach($messages as $message)
                <div class="mb-3 d-flex {{ $message->sender_id == Auth::id() ? 'justify-content-start' : 'justify-content-end' }}">
                    @if ($message->sender_id == Auth::id())
                        <div class="alert" style="width: 100%; text-align: left; background-color: #B3E5FC; border-color: #81D4FA; color: #01579B; border-radius: 10px;">
                            <strong>Vous :</strong> {{ $message->body }}
                            <br>
                            <small>{{ $message->created_at->diffForHumans() }}</small>
                        </div>
                    @else
                        <div class="alert" style="width: 100%; text-align: right; background-color: #C8E6C9; border-color: #A5D6A7; color: #388E3C; border-radius: 10px;">
                            <strong>{{ $message->sender->name }} :</strong> {{ $message->body }}
                            <br>
                            <small>{{ $message->created_at->diffForHumans() }}</small>
                        </div>
                    @endif
                </div>
            @endforeach
        @endif
    </div>
</div>

@section('js')
<script>
    // Fonction pour défiler vers le bas
    function scrollToBottom() {
        var messageContainer = document.getElementById('messageContainer');
        messageContainer.scrollTop = messageContainer.scrollHeight;
    }

    // Appeler la fonction lorsque la page est complètement chargée
    window.onload = scrollToBottom;

    // Appeler la fonction à chaque fois que le formulaire est soumis pour rafraîchir l'affichage
    document.querySelector('form').addEventListener('submit', function() {
        setTimeout(scrollToBottom, 100);  // Un léger délai pour assurer que le message est affiché
    });
</script>
@endsection

<!-- Pour éviter les chevauchements et les problèmes d'espacement -->
<div style="clear: both;"></div>

<!-- Formulaire d'envoi de message -->
<form method="POST" action="{{ route('message.store', $receiver->id) }}" class="mt-4">
    @csrf
    <div class="form-group">
        <textarea class="form-control" name="body" rows="3" placeholder="Votre message..." required></textarea>
    </div>
    <button type="submit" class="btn btn-primary mt-2">Envoyer</button>
</form>

<!-- Espace entre les deux boutons -->
<div class="my-4"></div>

<!-- Bouton pour commencer une nouvelle conversation -->
<a href="{{ route('messages.createConversation') }}" class="btn btn-outline-success">Revenir à la liste des contacts</a>

@endsection
