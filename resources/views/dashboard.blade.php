@extends('adminlte::page') <!-- Extends the main layout -->

@section('title', 'Mon Tableau de Bord')

@section('content')
<div class="container-fluid">
    <h1>Bienvenue, {{ Auth::user()->firstname }}!</h1>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if (session('status'))
    <div class="alert alert-info">
        {{ session('status') }}
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="fas fa-bell"></i> Notifications</h5>
    </div>
    <div class="card-body">
        @if(auth()->user()->unreadNotifications->isEmpty())
            <p class="text-center text-muted">Aucune notification.</p>
        @else
            <ul class="list-group">
                @foreach(auth()->user()->unreadNotifications as $notification)
                    <li class="list-group-item d-flex justify-content-between align-items-center" id="notification-{{ $notification->id }}">
                        <div>
                            <i class="fas fa-envelope text-primary"></i>
                            <strong>Nouveau message de {{ $notification->data['sender_name'] }}</strong> :
                            <span class="text-muted">{{ $notification->data['message_body'] }}</span>
                        </div>
                        <button class="btn btn-primary btn-sm" onclick="markAsRead('{{ $notification->id }}', '{{ $notification->data['sender_id'] }}')">
                            <i class="fas fa-eye"></i> Voir le message
                        </button>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>

<!-- Script AJAX -->
<script>
    function markAsRead(notificationId, senderId) {
        fetch(`/notifications/${notificationId}/mark-as-read`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(response => {
            if (response.ok) {
                // Supprimer la notification de l'interface après succès
                document.getElementById(`notification-${notificationId}`).remove();
                // Rediriger vers la page du message
                window.location.href = `/messages/${senderId}`;
            } else {
                console.error('Erreur lors de la mise à jour de la notification.');
            }
        }).catch(error => {
            console.error('Erreur lors de la requête:', error);
        });
    }
</script>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Événements à Venir</h5>
        </div>
        <div class="card-body">
            @if (Auth::user()->role === 'admin')
            <a href="{{ route('events.create') }}" class="btn btn-primary mb-3">Créer un Événement</a>
            @endif

            @if($events->isEmpty())
                <p>Aucun événement à venir.</p>
            @else
                <ul class="list-group">
                    @foreach($events as $event)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <strong>{{ $event->title }}</strong> - {{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y') }}
                                    <p>{{ $event->description }}</p>
                                    @if($event->photo)
                                        <img src="{{ asset('storage/public/events/' . $event->photo) }}" alt="Event Photo" class="img-thumbnail" width="150">
                                    @endif
                                </div>
                                @if (Auth::user()->role === 'admin')
                                <div class="btn-group" role="group">
                                    <a href="{{ route('events.edit', $event) }}" class="btn btn-warning btn-sm">Modifier</a>

                                    <form action="{{ route('events.destroy', $event) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement?');">Supprimer</button>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection
