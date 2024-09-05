@extends('adminlte::page')

@section('title', 'Détails de l\'Événement')

@section('content_header')
    <h1>Détails de l'Événement</h1>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $event->title }}</h3>
                <div class="card-tools">
                    <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <p><strong>Description:</strong></p>
                        <p>{{ $event->description }}</p>

                        <p><strong>Date et Heure:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y H:i') }}</p>
                        <p><strong>Lieu:</strong> {{ $event->location ?? 'Non spécifié' }}</p>
                    </div>
                    <div class="col-md-4">
                        @if($event->photo)
                            <img src="{{ asset('storage/public/events/' . $event->photo) }}" alt="{{ $event->title }}" class="img-fluid img-thumbnail">
                        @else
                            <p>Aucune photo disponible</p>
                        @endif
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <a href="{{ route('events.index') }}" class="btn btn-secondary mt-3">Retour à la liste des événements</a>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Page d\'affichage d\'événement chargée'); </script>
@stop
