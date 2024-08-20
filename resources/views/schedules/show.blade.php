@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Planning pour {{ $schedule->activityGroup->activity->title }} - {{ $schedule->activityGroup->group->title }}</h1>

    <table class="table">
        <tr>
            <th>Lundi</th>
            <td>{{ $schedule->monday }}</td>
        </tr>
        <tr>
            <th>Mardi</th>
            <td>{{ $schedule->tuesday }}</td>
        </tr>
        <tr>
            <th>Mercredi</th>
            <td>{{ $schedule->wednesday }}</td>
        </tr>
        <tr>
            <th>Jeudi</th>
            <td>{{ $schedule->thursday }}</td>
        </tr>
        <tr>
            <th>Vendredi</th>
            <td>{{ $schedule->friday }}</td>
        </tr>
        <tr>
            <th>Samedi</th>
            <td>{{ $schedule->saturday }}</td>
        </tr>
    </table>

    <a href="{{ route('schedules.edit', $schedule->id) }}" class="btn btn-warning">Modifier</a>
    <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>
</div>
@endsection
