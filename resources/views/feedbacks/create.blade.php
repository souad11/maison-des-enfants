@extends('adminlte::page')

@section('content')
    <h1>Créer un Feedback pour {{ $child->firstname }} {{ $child->lastname }}</h1>

    <form action="{{ route('feedbacks.store') }}" method="POST">
        @csrf

        <!-- Les IDs sont préremplis et cachés -->
        <input type="hidden" name="child_id" value="{{ $child->id }}">
        <input type="hidden" name="activity_group_id" value="{{ $activityGroup->id }}">

        <!-- Affichage des informations de l'activité et du groupe -->
        <div class="form-group">
            <label for="activity_group">Activité / Groupe</label>
            <input type="text" id="activity_group" class="form-control" value="{{ $activityGroup->activity->title }} / {{ $activityGroup->group->title }}" disabled>
        </div>

        <!-- Champ de texte pour le feedback -->
        <div class="form-group">
            <label for="content">Feedback</label>
            <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Soumettre</button>
    </form>
@endsection
