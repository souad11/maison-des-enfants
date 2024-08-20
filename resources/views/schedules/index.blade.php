@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Liste des Plannings</h1>

    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    <!-- Bouton pour créer un nouveau planning -->
    <a href="{{ route('schedules.create') }}" class="btn btn-primary mb-3">Créer un Nouveau Planning</a>

    @if($schedules->isEmpty())
        <div class="alert alert-info">
            Aucun planning n'est disponible.
        </div>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Groupe d'Activité</th>
                    <th>Lundi</th>
                    <th>Mardi</th>
                    <th>Mercredi</th>
                    <th>Jeudi</th>
                    <th>Vendredi</th>
                    <th>Samedi</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schedules as $schedule)
                    <tr>
                        <td>{{ $schedule->id }}</td>
                        <td>{{ $schedule->activityGroup->activity->title }} - {{ $schedule->activityGroup->group->title }} - {{ $schedule->activityGroup->group->min_age }} à {{ $schedule->activityGroup->group->max_age }} ans </td>
                        <td>{{ $schedule->monday }}</td>
                        <td>{{ $schedule->tuesday }}</td>
                        <td>{{ $schedule->wednesday }}</td>
                        <td>{{ $schedule->thursday }}</td>
                        <td>{{ $schedule->friday }}</td>
                        <td>{{ $schedule->saturday }}</td>
                        <td>
                            <a href="{{ route('schedules.show', $schedule->id) }}" class="btn btn-info">Voir</a>
                            <a href="{{ route('schedules.edit', $schedule->id) }}" class="btn btn-warning">Modifier</a>
                            <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
