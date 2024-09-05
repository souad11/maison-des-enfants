@extends('adminlte::page')

@section('title', 'Événements')

@section('content_header')
    <h1>Gestion des Événements</h1>
@stop

@section('content')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Liste des Événements</h3>
                <div class="card-tools">
                    <a href="{{ route('events.create') }}" class="btn btn-primary">Ajouter un événement</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @if($events->isEmpty())
                    <p class="text-center">Aucun événement à afficher.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Description</th>
                                <th>Date de l'événement</th>
                                <th>Photo</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                                <tr>
                                    <td>{{ $event->title }}</td>
                                    <td>{{ $event->description }}</td>
                                    <td>{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y H:i') }}</td>
                                    <td>
                                        @if($event->photo)
                                            <img src="{{ asset('storage/public/events/' . $event->photo) }}" alt="{{ $event->title }}" class="img-thumbnail" style="width: 100px;">
                                        @else
                                            Pas de photo
                                        @endif
                                    </td>
                                    <td>
                                    <a href="{{ route('events.show', $event->id) }}" class="btn btn-info btn-sm">Voir</a>

                                        <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                        <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?');">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
