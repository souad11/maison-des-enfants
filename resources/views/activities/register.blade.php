@extends('layouts.template')

@section('title', 'Inscription à l\'Activité')

@section('content')
<div class="container">
    <h1>Inscription à l'Activité: {{ $activity->title }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('registrations.store') }}" method="POST" style="max-width: 600px; margin: auto;">
        @csrf
        <input type="hidden" name="activity_id" value="{{ $activity->id }}">

        <div class="form-group">
            <label for="child_id">Choisir un Enfant:</label>
            <select class="form-control @error('child_id') is-invalid @enderror" id="child_id" name="child_id" required>
                @foreach($children as $child)
                    <option value="{{ $child->id }}">{{ $child->firstname }}</option>
                @endforeach
            </select>
            @error('child_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="group_id">Choisir un Groupe:</label>
            <select class="form-control @error('group_id') is-invalid @enderror" id="group_id" name="group_id" required>
                @foreach($availableGroups as $group)
                    <option value="{{ $group->id }}">{{ $group->title }} ({{ $group->min_age }}-{{ $group->max_age }})</option>
                @endforeach
            </select>
            @error('group_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="text-center mt-4"> <!-- Centre le bouton et ajoute de la marge -->
            <button type="submit" class="btn btn-primary">Inscrire</button>
        </div>
    </form>
</div>
@endsection

@section('css')
    <style>
        select.form-control {
            max-width: 100%; /* Adjust the width as necessary */
            display: block; /* Adjust display to block for better control */
            width: auto; /* Make width automatic to content */
        }
    </style>
@stop
