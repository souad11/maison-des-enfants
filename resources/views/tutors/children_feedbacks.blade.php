@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Rapports des Enfants</h1>

<!-- Texte explicatif pour les parents -->
<div class="p-4 mb-4" style="background-color: #e3f2fd; border: 1px solid #b3e5fc; border-radius: 10px;">
    <p class="lead" style="font-size: 1.2rem; color: #01579b;">
        <strong>Chers parents,</strong> voici la liste des rapports pour vos enfants inscrits à nos activités. 
        Vous pouvez consulter les retours des éducateurs sur leur participation aux différents stages auxquels ils sont inscrits.
    </p>
    <p style="font-size: 1rem; color: #0277bd;">
        <strong>Besoin de plus de détails ?</strong> N'hésitez pas à contacter les animateurs pour toute question ou pour obtenir des informations complémentaires sur les progrès de vos enfants.
    </p>
</div>





    <!-- Formulaire de filtrage des enfants -->
    <form method="GET" action="{{ route('tutors.children_feedbacks') }}" class="mb-4">
        <div class="form-group">
            <label for="child_id">Filtrer par enfant :</label>
            <select name="child_id" id="child_id" class="form-control" onchange="this.form.submit()">
                <option value="">Tous les enfants</option>
                @foreach($children as $child)
                    <option value="{{ $child->id }}" {{ $selectedChild == $child->id ? 'selected' : '' }}>
                        {{ $child->firstname }} {{ $child->lastname }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

   <!-- Affichage des feedbacks -->
@if($children->isEmpty())
    <div class="alert alert-info text-center p-4">
        <i class="fas fa-info-circle fa-2x"></i><br>
        Vous n'avez aucun enfant inscrit à des activités.
    </div>
@else
    @foreach($children as $child)
        <div class="mb-5 p-3" style="border-left: 5px solid black; background-color: #f8f9fa; border-radius: 10px;">
            <h2 class="text">{{ $child->firstname }} {{ $child->lastname }}</h2>

            @if($child->feedbacks->isEmpty())
                <div class="alert alert-warning p-3 text-center">
                    <i class="fas fa-exclamation-triangle"></i> Aucun rapport disponible pour cet enfant.
                </div>
            @else
                @foreach($child->feedbacks as $feedback)
                    <div class="mb-3 p-3" style="background-color: #fff; border: 1px solid #ddd; border-radius: 10px;">
                        <h5 class="text-dark font-weight-bold">{{ $feedback->activityGroup->activity->title }}</h5>
                        <p class="text-muted mb-1"><strong>Groupe :</strong> {{ $feedback->activityGroup->group->title }}</p>
                        <p class="text-secondary">{{ $feedback->content }}</p>
                        <p class="text-right text-muted mb-0">
                            <small>Rapporté le {{ \Carbon\Carbon::parse($feedback->created_at)->format('d/m/Y') }}</small>
                        </p>
                    </div>
                @endforeach
            @endif
        </div>
    @endforeach
@endif
@endsection