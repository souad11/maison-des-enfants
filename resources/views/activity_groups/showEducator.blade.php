@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Mes Groupes d'Activités</h1>

    @if($activityGroups->isEmpty())
        <div class="alert alert-info">
            Vous ne gérez actuellement aucun groupe d'activités.
        </div>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Activité</th>
                    <th>Groupe</th>
                    <th>Âge</th>
                    <th>Action</th> <!-- Colonne pour le lien Feedback -->
                </tr>
            </thead>
            <tbody>
                @foreach($activityGroups as $activityGroup)
                    <tr>
                        <td>{{ $activityGroup->id }}</td>
                        <td>{{ $activityGroup->activity->title }}</td>
                        <td>{{ $activityGroup->group->title }}</td>
                        <td>{{ $activityGroup->group->min_age }} - {{ $activityGroup->group->max_age }} ans</td>
                        <td>
                        <a href="{{ route('feedbacks.children', ['activity_group_id' => $activityGroup->id]) }}" class="btn btn-primary">Donner Feedback</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
