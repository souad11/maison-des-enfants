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
            <div class="card mb-3">
                <div class="card-header text-blue">
                    <h2 class="mb-0">{{ $child->firstname }} {{ $child->lastname }}</h2>
                </div>
                <div class="card-body">
                    @if($child->registrations->isEmpty())
                        <div class="alert alert-warning">
                            Aucun planning disponible pour cet enfant.
                        </div>
                    @else
                        @foreach($child->registrations->unique('activity_group_id') as $registration)
                            @php
                                $activityGroup = $registration->activityGroup;
                                $schedule = $activityGroup->schedule;
                            @endphp
                            <div class="mb-4">
                                <h4 class="font-weight-bold">{{ $activityGroup->activity->title }} - {{ $activityGroup->group->title }}</h4>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Jour</th>
                                            <th>Horaire</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(['monday' => 'Lundi', 'tuesday' => 'Mardi', 'wednesday' => 'Mercredi', 'thursday' => 'Jeudi', 'friday' => 'Vendredi', 'saturday' => 'Samedi'] as $day => $dayName)
                                            @if($schedule->$day)
                                                <tr>
                                                    <td>{{ $dayName }}</td>
                                                    <td>{{ $schedule->$day }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
