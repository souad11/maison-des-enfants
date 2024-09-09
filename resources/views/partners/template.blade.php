@extends('layouts.template')

@section('title', 'Nos Partenaires')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-5 p-3 bg-light text-dark" style="border-radius: 5px;">Nos Partenaires</h1>

    <!-- Introduction text -->
    <p class="lead text-center mb-5">
        Nous collaborons avec des partenaires de confiance qui partagent nos valeurs et notre engagement envers l'éducation et le développement des enfants. Ensemble, nous offrons une variété de ressources et de services pour enrichir l'expérience des enfants et de leurs familles.
    </p>
    @if($partners->isEmpty())
        <p class="text-center">Aucun partenaire trouvé.</p>
    @else
        <div class="row">
            @foreach($partners as $partner)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if($partner->picture)
                            <img src="{{ asset('storage/' . $partner->picture) }}" class="card-img-top" alt="{{ $partner->name }}">
                        @else
                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="Image du partenaire">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $partner->name }}</h5>
                            <p class="card-text">{{ Str::limit($partner->description, 100) }}</p>
                            <p class="text-muted">
                                <strong>Adresse:</strong> {{ $partner->address }}<br>
                                <strong>Téléphone:</strong> {{ $partner->phone_number }}<br>
                                <strong>Site Web:</strong> <a href="{{ $partner->website }}" target="_blank">{{ $partner->website }}</a>
                            </p>
                            <a href="{{ route('partners.showTemplate', $partner->id) }}" class="btn btn-primary">Voir plus</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
