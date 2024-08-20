@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Créer un Planning</h1>

    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    <form action="{{ route('schedules.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="activity_group_id">Sélectionnez un Groupe d'Activité</label>
            <select name="activity_group_id" id="activity_group_id" class="form-control" required>
                <option value="">-- Sélectionnez un Groupe d'Activité --</option>
                @foreach($activityGroups as $activityGroup)
                    <option value="{{ $activityGroup->id }}">
                        {{ $activityGroup->activity->title }} - {{ $activityGroup->group->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="monday">Lundi</label>
            <input type="text" name="monday" id="monday" class="form-control">
        </div>

        <div class="form-group">
            <label for="tuesday">Mardi</label>
            <input type="text" name="tuesday" id="tuesday" class="form-control">
        </div>

        <div class="form-group">
            <label for="wednesday">Mercredi</label>
            <input type="text" name="wednesday" id="wednesday" class="form-control">
        </div>

        <div class="form-group">
            <label for="thursday">Jeudi</label>
            <input type="text" name="thursday" id="thursday" class="form-control">
        </div>

        <div class="form-group">
            <label for="friday">Vendredi</label>
            <input type="text" name="friday" id="friday" class="form-control">
        </div>

        <div class="form-group">
            <label for="saturday">Samedi</label>
            <input type="text" name="saturday" id="saturday" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Créer le Planning</button>
    </form>
</div>
@endsection
