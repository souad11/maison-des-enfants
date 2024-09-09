@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Rapports des Enfants</h1>

<!-- Texte explicatif pour les parents -->
<div class="p-4 mb-4" style="background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 10px;">
    <p class="lead" style="font-size: 1.2rem; color: #000;">
        <strong>Chers parents,</strong> voici la liste des rapports pour vos enfants inscrits à nos activités. 
        Vous pouvez consulter les retours des éducateurs sur leur participation aux différents stages auxquels ils sont inscrits.
    </p>
    <p style="font-size: 1rem; color: #000;">
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
        <div class="alert alert-info">
            Vous n'avez aucun enfant inscrit à des activités.
        </div>
    @else
        @foreach($children as $child)
            <h2>{{ $child->firstname }} {{ $child->lastname }}</h2>

            @if($child->feedbacks->isEmpty())
                <div class="alert alert-warning">
                    Aucun rapport disponible pour cet enfant.
                </div>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Activité</th>
                            <th>Groupe</th>
                            <th>Rapports</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($child->feedbacks as $feedback)
                            <tr>
                                <td>{{ $feedback->activityGroup->activity->title }}</td>
                                <td>{{ $feedback->activityGroup->group->title }}</td>
                                <td>{{ $feedback->content }}</td>
                                <td>{{ \Carbon\Carbon::parse($feedback->created_at)->format('d/m/Y') }}</td>
                                </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        @endforeach
    @endif
</div>
@endsection
