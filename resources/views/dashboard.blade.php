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
