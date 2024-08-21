@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Plannings des Activités</h1>

    @if($children->isEmpty())
        <div class="alert alert-info">
            Vous n'avez aucun enfant inscrit à des activités.
        </div>
    @else
        @foreach($children as $child)
            <h2>{{ $child->firstname }} {{ $child->lastname }}</h2>

            @if($child->registrations->isEmpty())
                <div class="alert alert-warning">
                    Aucun planning disponible pour cet enfant.
                </div>
            @else
                @foreach($child->registrations as $registration)
                    @php
                        $activityGroup = $registration->activityGroup;
                    @endphp
                    <h3>{{ $activityGroup->activity->title }} - {{ $activityGroup->group->title }}</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Jour</th>
                                <th>Horaire</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($activityGroup->schedule->monday)
                                <tr>
                                    <td>Lundi</td>
                                    <td>{{ $activityGroup->schedule->monday }}</td>
                                </tr>
                            @endif
                            @if($activityGroup->schedule->tuesday)
                                <tr>
                                    <td>Mardi</td>
                                    <td>{{ $activityGroup->schedule->tuesday }}</td>
                                </tr>
                            @endif
                            @if($activityGroup->schedule->wednesday)
                                <tr>
                                    <td>Mercredi</td>
                                    <td>{{ $activityGroup->schedule->wednesday }}</td>
                                </tr>
                            @endif
                            @if($activityGroup->schedule->thursday)
                                <tr>
                                    <td>Jeudi</td>
                                    <td>{{ $activityGroup->schedule->thursday }}</td>
                                </tr>
                            @endif
                            @if($activityGroup->schedule->friday)
                                <tr>
                                    <td>Vendredi</td>
                                    <td>{{ $activityGroup->schedule->friday }}</td>
                                </tr>
                            @endif
                            @if($activityGroup->schedule->saturday)
                                <tr>
                                    <td>Samedi</td>
                                    <td>{{ $activityGroup->schedule->saturday }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                @endforeach
            @endif
        @endforeach
    @endif
</div>
@endsection
