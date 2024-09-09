@extends('layouts.template')

@section('title', 'Nos Stages')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-5 p-3 bg-light text-dark" style="border-radius: 5px;">Nos Stages</h1>
    
    <!-- Section for Weekly Activities -->
    <section class="mb-5">
        <h2 class="text-primary">Stages Hebdomadaires</h2>
        <p class="lead">
            Organisées pendant les semaines de congé scolaire, ces Stages visent à engager les enfants dans des expériences enrichissantes et amusantes qui complètent leur éducation scolaire régulière. Chaque semaine est thématique et conçue pour stimuler la curiosité et l'exploration. Nos programmes hebdomadaires sont variés, allant des ateliers créatifs aux sorties éducatives, en passant par des activités enrichissantes et des découvertes scientifiques.
        </p>
    </section>

    <!-- Section for Yearly Activities -->
    <section class="mb-5">
        <h2 class="text-primary">Stages à l'année</h2>
        <p class="lead">
            Nos Stages à l'année sont conçues pour offrir une continuité dans l'apprentissage et le développement des enfants tout au long de l'année scolaire. Ces programmes permettent aux enfants de s'immerger plus profondément dans leurs domaines d'intérêt tout en bénéficiant d'un encadrement régulier et structuré.
        </p>
    </section>

    <div class="mb-5 text-center">
        <form action="{{ route('activities.filter') }}" method="GET" class="form-inline justify-content-center">
            <div class="input-group" style="max-width: 400px;">
                <label for="filter" class="input-group-text">Filtrer par :</label>
                <select name="filter" id="filter" class="form-select">
                    <option value="">-- Tous les types --</option>
                    <option value="annuel" {{ request('filter') == 'annuel' ? 'selected' : '' }}>Stages à l'année</option>
                    <option value="hebdomadaire" {{ request('filter') == 'hebdomadaire' ? 'selected' : '' }}>Stages hebdomadaires</option>
                </select>
                <button type="submit" class="btn btn-primary">Filtrer</button>
            </div>
        </form>
    </div>

    @if($activities->isEmpty())
        <div class="alert alert-info text-center">
            Aucune activité disponible pour le moment.
        </div>
    @else
        <div class="row">
        @foreach($activities as $activityGroup)
    <div class="col-md-4 mb-4">
        <div class="card border-light shadow-sm">
<!-- Card Header -->
<div class="card-header bg-light border-bottom" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    <h5 class="card-title mb-0 text-primary">{{ $activityGroup->activity->title }}</h5>
</div>


            
            <!-- Card Body -->
            <div class="card-body">
                <p class="card-text">{{ $activityGroup->activity->description }}</p>
                <p class="card-text">
                    <strong>Période :</strong> Du {{ \Carbon\Carbon::parse($activityGroup->activity->start_date)->isoFormat('D MMM YYYY') }}
                    au {{ \Carbon\Carbon::parse($activityGroup->activity->end_date)->isoFormat('D MMM YYYY') }}
                </p>
                <p class="card-text">
                    <strong>Groupe :</strong> {{ $activityGroup->group->title }} ({{ $activityGroup->group->min_age }} à {{ $activityGroup->group->max_age }} ans)
                </p>
                <p class="card-text">
                    <strong>Capacité :</strong> {{ $activityGroup->capacity }}
                </p>
                <p class="card-text">
                    <strong>Places Disponibles :</strong> {{ $activityGroup->available_space }}
                </p>
                <p class="card-text">
                    <strong>Prix :</strong> 
                    
                        {{ $activityGroup->activity->price->price }} €
                    
                </p>
            </div>
            
            <!-- Card Footer -->
            <div class="card-footer text-end">
                @if (Auth::check() && Auth::user()->role == 'tutor')
                    <a href="{{ route('activity_group.register', $activityGroup->id) }}" class="btn btn-outline-primary btn-sm">Inscrire son enfant</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-sm">Connectez-vous pour inscrire votre enfant</a>
                @endif
            </div>
        </div>
    </div>
@endforeach

        </div>
    @endif
</div>
@endsection
