@extends('adminlte::page')

@section('content')
<div class="container">
    <h1 class="mb-5">Inscriptions des Enfants</h1>

    <!-- Texte d'introduction -->
    <p class="lead mb-4">
        Chers parents, vous trouverez ci-dessous les détails des inscriptions de vos enfants aux différentes activités. 
        Consultez les groupes d'activités auxquels ils participent ainsi que le statut de chaque inscription. Si vous avez des questions, n'hésitez pas à nous contacter.
    </p>

    @if($children->isEmpty())
        <div class="alert alert-info">
            Vous n'avez aucun enfant inscrit à des activités.
        </div>
    @else
        @foreach($children as $child)
            <div class="card mb-4">
            <div class="card-header text-white" style="background-color: #6c757d;">
    <h2 class="mb-0">{{ $child->firstname }} {{ $child->lastname }}</h2>
</div>

                <div class="card-body">
                    @if($child->registrations->isEmpty())
                        <div class="alert alert-warning">
                            Aucun groupe d'activités n'a été trouvé pour cet enfant.
                        </div>
                    @else
                        <table class="table table-bordered table-striped">
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
                                    @if($activityGroup) <!-- Vérification que l'activityGroup n'est pas nul -->
                                        <tr>
                                            <td>{{ $activityGroup->activity->title }}</td>
                                            <td>{{ $activityGroup->group->title }}</td>
                                            <td>
                                                <span class="badge 
                                                    @if($registration->status == 'approved') bg-success 
                                                    @elseif($registration->status == 'pending') bg-warning 
                                                    @else bg-danger @endif">
                                                    {{ ucfirst($registration->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="3" class="text-center">Données manquantes pour cette inscription.</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
