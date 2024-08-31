@extends('layouts.template')

@section('title', 'Nos Activités')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-5 p-3 bg-light text-dark" style="border-radius: 5px;">Nos Activités</h1>
    
    <!-- Section for Weekly Activities -->
    <section class="mb-5">
        <h2 class="text-primary">Activités Hebdomadaires</h2>
        <p class="lead">
            Organisées pendant les semaines de congé scolaire, ces activités visent à engager les enfants dans des expériences enrichissantes et amusantes qui complètent leur éducation scolaire régulière. Chaque semaine est thématique et conçue pour stimuler la curiosité et l'exploration. Nos programmes hebdomadaires sont variés, allant des ateliers créatifs aux sorties éducatives, en passant par des activités sportives et des découvertes scientifiques.
        </p>
        <p>
            Ces sessions sont spécialement préparées pour maintenir les enfants actifs et impliqués, en leur proposant des défis adaptés à leur âge et en encourageant le développement de nouvelles compétences. C’est une occasion parfaite pour les enfants de faire des rencontres enrichissantes, de développer leur autonomie et de renforcer leur confiance en eux dans un cadre sécurisé et stimulant.
        </p>
    </section>

    @if($activities->isEmpty())
        <div class="alert alert-info text-center">
            Aucune activité disponible pour le moment.
        </div>
    @else
        <div class="row">
            @foreach($activities as $activityGroup)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $activityGroup->activity->title }}</h5>
                            <p class="card-text">{{ $activityGroup->activity->description }}</p>
                            <p class="card-text">
                                Du {{ \Carbon\Carbon::parse($activityGroup->activity->start_date)->isoFormat('D MMM YYYY') }}
                                au {{ \Carbon\Carbon::parse($activityGroup->activity->end_date)->isoFormat('D MMM YYYY') }}
                            </p>
                            <p class="card-text">Groupe : {{ $activityGroup->group->title }} ({{ $activityGroup->group->min_age }} à {{ $activityGroup->group->max_age }} ans)</p>
                            <p class="card-text">Capacité : {{ $activityGroup->capacity }}</p>
                            <p class="card-text">Places Disponibles : {{ $activityGroup->available_space }}</p>
                        </div>
                        <div class="card-footer text-right">
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
