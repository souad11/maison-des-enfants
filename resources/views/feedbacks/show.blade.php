@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Feedback pour {{ $feedback->child->firstname }} {{ $feedback->child->lastname }}</h1>

    <div class="card">
        <div class="card-header">
            <h3>{{ $feedback->activityGroup->activity->title }} - {{ $feedback->activityGroup->group->title }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Enfant :</strong> {{ $feedback->child->firstname }} {{ $feedback->child->lastname }}</p>
            <p><strong>Activité :</strong> {{ $feedback->activityGroup->activity->title }}</p>
            <p><strong>Groupe :</strong> {{ $feedback->activityGroup->group->title }}</p>
            
            <p><strong>Feedback :</strong></p>
            <p>{{ $feedback->content }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('feedbacks.edit', $feedback->id) }}" class="btn btn-warning">Modifier</a>
            <a href="{{ route('feedbacks.children', ['activity_group_id' => $feedback->activityGroup->id]) }}" class="btn btn-secondary">Retour à la liste d'enfants</a>
            </div>
    </div>
</div>
@endsection
