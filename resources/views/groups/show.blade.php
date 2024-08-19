@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Détails du Groupe</h1>
    
    <div class="card mb-4">
        <div class="card-header">
            <h2>{{ $group->title }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Âge minimum :</strong> {{ $group->min_age }} ans</p>
            <p><strong>Âge maximum :</strong> {{ $group->max_age }} ans</p>
            <p><strong>Capacité :</strong> {{ $group->capacity }} enfants</p>
            <p><strong>Places disponibles :</strong> {{ $group->available_space }}</p>
        </div>
    </div>

    <h3>Activités associées :</h3>
    @if($group->activities->isEmpty())
        <p>Aucune activité associée à ce groupe.</p>
    @else
        <ul class="list-group">
            @foreach($group->activities as $activity)
                <li class="list-group-item">
                    <strong>{{ $activity->name }}</strong>
                    <p>{{ $activity->description }}</p>
                </li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('groups.index') }}" class="btn btn-primary mt-3">Retour à la liste des groupes</a>
    <a href="{{ route('groups.edit', $group->id) }}" class="btn btn-secondary mt-3">Modifier le groupe</a>
</div>
@endsection
