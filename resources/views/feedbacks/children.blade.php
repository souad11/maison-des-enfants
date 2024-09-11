@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Donner un Feedback pour {{ $activityGroup->activity->title }} - {{ $activityGroup->group->title }}</h1>

    @if($children->isEmpty())
        <div class="alert alert-info">
            Aucun enfant n'est inscrit dans ce groupe d'activités.
        </div>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Enfant</th>
                    <th>Actions</th> <!-- Colonne pour les actions -->
                </tr>
            </thead>
            <tbody>
                @foreach($children as $child)
                    <tr>
                        <td>{{ $child->firstname }} {{ $child->lastname }}</td>
                        <td>
                            @if (!$child->feedbacks()->where('activity_group_id', $activityGroup->id)->exists())
                                <a href="{{ route('feedbacks.create', ['child_id' => $child->id, 'activity_group_id' => $activityGroup->id]) }}" class="btn btn-primary">Créer un Feedback</a>
                            @else
                                @php
                                    $feedback = $child->feedbacks()->where('activity_group_id', $activityGroup->id)->first();
                                @endphp
                                <span class="text-success">Feedback déjà créé</span>
                                <!-- Bouton pour afficher le feedback -->
                                <a href="{{ route('feedbacks.show', $feedback->id) }}" class="btn btn-info">Afficher</a>
                                <!-- Bouton pour éditer le feedback -->
                                <a href="{{ route('feedbacks.edit', $feedback->id) }}" class="btn btn-warning">Modifier</a>
                                <form action="{{ route('feedbacks.destroy', $feedback->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                                @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
