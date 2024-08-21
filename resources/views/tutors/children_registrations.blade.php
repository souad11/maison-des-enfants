
@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Inscriptions des Enfants</h1>
    <h1>A FAIRE </h1>
    @if($children->isEmpty())
        <div class="alert alert-info">
            Vous n'avez aucun enfant inscrit à des activités.
        </div>
    @else
        @foreach($children as $child)
            <h2>{{ $child->firstname }} {{ $child->lastname }}</h2>

            @if($child->registrations->isEmpty())
                <div class="alert alert-warning">
                    Aucun groupe d'activités n'a été trouvé pour cet enfant.
                </div>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Activité</th>
                            <th>Groupe</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($child->registrations as $registration)
                            @php
                                $activityGroup = $registration->activityGroup;
                            @endphp
                            <tr>
                                <td>{{ $activityGroup->activity->title }}</td>
                                <td>{{ $activityGroup->group->title }}</td>
                                <td>{{ $registration->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        @endforeach
    @endif
</div>
@endsection
