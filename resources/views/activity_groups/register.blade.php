@extends('layouts.template')

@section('title', 'Inscription à une activité')

@section('content')
<div class="container">
    <h1>Inscription à : {{ $activityGroup->activity->title }}</h1>
    <p class="text-muted">
        Groupe : {{ $activityGroup->group->title }} (pour les âges de {{ $activityGroup->group->min_age }} à {{ $activityGroup->group->max_age }} ans)
    </p>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('registrations.store') }}" method="POST">
        @csrf
        <input type="hidden" name="activity_group_id" value="{{ $activityGroup->id }}">
        
        <div class="form-group">
            <label for="child_id">Choisir un enfant :</label>
            <select name="child_id" id="child_id" class="form-control" required>
                @foreach ($children as $child)
                    <option value="{{ $child->id }}">{{ $child->firstname }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Inscrire</button>
    </form>
</div>
@endsection
