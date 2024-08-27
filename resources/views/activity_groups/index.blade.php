@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Liste des Associations Activité-Groupe</h1>
    <a href="{{ route('activity_groups.create') }}" class="btn btn-primary mb-3">Créer une Nouvelle Association</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Activité</th>
                <th>Groupe</th>
                <th>Éducateur</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($activityGroups as $activityGroup)
                <tr>
                    <td>{{ $activityGroup->id }}</td>
                    <td>{{ $activityGroup->activity->title }}</td>
                    <td>{{ $activityGroup->group->title }} ({{ $activityGroup->group->min_age }}-{{ $activityGroup->group->max_age }} ans)</td>
                    <td>{{ $activityGroup->educator->user->firstname }} {{ $activityGroup->educator->user->lastname }}</td>
                    <td>
                        <!-- Bouton Modifier -->
                        <a href="{{ route('activity_groups.edit', $activityGroup->id) }}" class="btn btn-warning">Modifier</a>

                        <!-- Bouton Supprimer -->
                        <form action="{{ route('activity_groups.destroy', $activityGroup->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette association ?');">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
