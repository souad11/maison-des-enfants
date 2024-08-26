@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Modifier le Feedback</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('feedbacks.update', $feedback->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="child">Enfant</label>
            <input type="text" id="child" class="form-control" value="{{ $feedback->child->firstname }} {{ $feedback->child->lastname }}" readonly>
        </div>

        <div class="form-group">
            <label for="activity_group">Groupe d'Activités</label>
            <input type="text" id="activity_group" class="form-control" value="{{ $feedback->activityGroup->activity->title }} - {{ $feedback->activityGroup->group->title }}" readonly>
        </div>

        <div class="form-group">
            <label for="content">Feedback</label>
            <textarea name="content" id="content" class="form-control" rows="5" required>{{ old('content', $feedback->content) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
