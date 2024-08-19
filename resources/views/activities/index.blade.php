@extends('adminlte::page')

@section('title', 'Liste des activités')

@section('content')
<div class="container">
    <h1>Activitiés</h1>
    <a href="{{ route('activities.create') }}" class="btn btn-primary">Ajouter une nouvelle activité</a>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($activities as $activity)
                <tr>
                    <td>{{ $activity->title }}</td>
                    <td>{{ $activity->description }}</td>
                    <td>{{ $activity->start_date }}</td>
                    <td>{{ $activity->end_date }}</td>
                    <td>
                        <a href="{{ route('activities.show', $activity) }}" class="btn btn-info">Voir</a>
                        <a href="{{ route('activities.edit', $activity) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('activities.destroy', $activity) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

