@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Modifier le Planning pour {{ $schedule->activityGroup->activity->title }} - {{ $schedule->activityGroup->group->title }} - {{ $schedule->activityGroup->group->min_age }} à {{ $schedule->activityGroup->group->max_age }} ans </h1>

    <form action="{{ route('schedules.update', $schedule->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="monday">Lundi</label>
            <input type="text" name="monday" id="monday" class="form-control" value="{{ $schedule->monday }}">
        </div>

        <div class="form-group">
            <label for="tuesday">Mardi</label>
            <input type="text" name="tuesday" id="tuesday" class="form-control" value="{{ $schedule->tuesday }}">
        </div>

        <div class="form-group">
            <label for="wednesday">Mercredi</label>
            <input type="text" name="wednesday" id="wednesday" class="form-control" value="{{ $schedule->wednesday }}">
        </div>

        <div class="form-group">
            <label for="thursday">Jeudi</label>
            <input type="text" name="thursday" id="thursday" class="form-control" value="{{ $schedule->thursday }}">
        </div>

        <div class="form-group">
            <label for="friday">Vendredi</label>
            <input type="text" name="friday" id="friday" class="form-control" value="{{ $schedule->friday }}">
        </div>

        <div class="form-group">
            <label for="saturday">Samedi</label>
            <input type="text" name="saturday" id="saturday" class="form-control" value="{{ $schedule->saturday }}">
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour le Planning</button>
    </form>
</div>
@endsection
