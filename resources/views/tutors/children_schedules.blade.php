@extends('adminlte::page')

@section('content')
<div class="container">
    <h1 class="mb-5">Plannings des Activités</h1>

    <!-- Texte introductif pour les parents -->
    <p class="lead mb-4">
        Chers parents, vous trouverez ci-dessous les plannings des stages auxquels vos enfants sont inscrits. 
        Consultez la description des stages jour après jour. Si vous avez des questions, n'hésitez pas à contacter l'équipe d'encadrement.
    </p>

    @if($children->isEmpty())
        <div class="alert alert-info">
            Vous n'avez aucun enfant inscrit à des activités.
        </div>
    @else
        @foreach($children as $child)
            <div class="card mb-4 shadow-sm">
                <div class="card-header text-white" style="background-color: #6c757d;">
                    <h2 class="mb-0">{{ $child->firstname }} {{ $child->lastname }}</h2>
                </div>

                <div class="card-body">
                    @if($child->registrations->isEmpty())
                        <div class="alert alert-warning">
                            Pas d'inscription à un stage d'activité, donc pas de planning.
                        </div>
                    @else
                        @foreach($child->registrations->unique('activity_group_id') as $registration)
                            @php
                                $activityGroup = $registration->activityGroup;
                                $schedule = $activityGroup->schedule;
                            @endphp

                            <!-- Vérification si l'inscription est finalisée et payée -->
                            @if($registration->status === 'paid') <!-- Vérifier que l'inscription est payée -->
                                @if($schedule) <!-- Vérifier que le planning existe -->
                                    <div class="mb-4">
                                        <h4 class="font-weight-bold">{{ $activityGroup->activity->title }} - {{ $activityGroup->group->title }}</h4>
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Jour</th>
                                                    <th>Horaire</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach(['monday' => 'Lundi', 'tuesday' => 'Mardi', 'wednesday' => 'Mercredi', 'thursday' => 'Jeudi', 'friday' => 'Vendredi', 'saturday' => 'Samedi'] as $day => $dayName)
                                                    @if(!empty($schedule->$day))
                                                        <tr>
                                                            <td>{{ $dayName }}</td>
                                                            <td>{{ $schedule->$day }}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @else
        <div class="alert alert-warning">
            Le planning pour l'activité "{{ $activityGroup->activity->title }}" n'est pas encore disponible.
        </div>
    @endif
@else
    <div class="alert alert-warning">
        L'inscription pour l'activité "{{ $activityGroup->activity->title }}" n'est pas encore finalisée ou payée, donc pas de planning disponible.
    </div>
@endif
                        @endforeach
                    @endif
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
