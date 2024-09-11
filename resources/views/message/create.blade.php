@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Envoyer un Message</h1>

    <!-- Formulaire d'envoi de message -->
    <form method="POST" action="{{ route('message.store') }}">
        @csrf

        <!-- Sélection du destinataire -->
        <div class="form-group">
            <label for="receiver_id">Destinataire :</label>
            <select class="form-control" id="receiver_id" name="receiver_id" required>
                <option value="" disabled selected>Choisir un destinataire</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->firstname }}</option>
                @endforeach
            </select>
        </div>

        <!-- Contenu du message -->
        <div class="form-group mt-3">
            <label for="body">Message :</label>
            <textarea class="form-control" id="body" name="body" rows="4" placeholder="Écrivez votre message ici..." required></textarea>
        </div>

        <!-- Bouton d'envoi -->
        <button type="submit" class="btn btn-primary mt-3">Envoyer</button>
    </form>
</div>
@endsection
