@extends('adminlte::page')

@section('title', 'Détails de l\'activité: ' . $activity->title)

@section('content_header')
    <h1>Détails de l'activité: {{ $activity->title }}</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title">{{ $activity->title }}</h3>
        </div>
        <div class="form-group">
    <label for="type">Type : </label>
    <p>{{ $activity->type == 'annuel' ? 'Activités à l\'année' : 'Activités hebdomadaires' }}</p>
</div>
        <div class="card-body">
            <p class="card-text"><strong>Description:</strong> {{ $activity->description }}</p>
            <p class="card-text">
                <strong>Date de début:</strong> 
                <span>{{ $activity->start_date}}</span>
            </p>
            <p class="card-text">
                <strong>Date de fin:</strong> 
                <span>{{ $activity->end_date }}</span>
            </p>
        </div>
        <div class="card-footer">
            <a href="{{ route('activities.edit', $activity->id) }}" class="btn btn-warning">Modifier l'activité</a>
            <a href="{{ route('activities.index') }}" class="btn btn-secondary">Retour à la liste des activités</a>
        </div>
    </div>
</div>
@stop
