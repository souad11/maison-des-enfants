@extends('adminlte::page')

@section('title', 'Groupes pour ' . $activity->title)

@section('content_header')
    <h1>Groupes pour l'activité: {{ $activity->title }}</h1>
@stop

@section('content')
<div class="container">
    <h2>Groupes associés à l'activité: {{ $activity->title }}</h2>
    
    @if($groups->isEmpty())
        <p>Aucun groupe associé à cette activité.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Âge Min</th>
                    <th>Âge Max</th>
                    <th>Capacité</th>
                    <th>Places Disponibles</th>
                </tr>
            </thead>
            <tbody>
                @foreach($groups as $group)
                    <tr>
                        <td>{{ $group->id }}</td>
                        <td>{{ $group->title }}</td>
                        <td>{{ $group->min_age }}</td>
                        <td>{{ $group->max_age }}</td>
                        <td>{{ $group->capacity }}</td>
                        <td>{{ $group->available_space }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@stop
