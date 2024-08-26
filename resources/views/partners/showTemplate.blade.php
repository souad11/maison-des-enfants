@extends('layouts.template')

@section('title', $partner->name)

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-5 p-3 bg-light text-dark" style="border-radius: 5px;">{{ $partner->name }}</h1>

    <div class="card mb-5 shadow-sm">
        @if($partner->picture)
        <img src="{{ asset('storage/' . $partner->picture) }}" class="card-img-top" alt="{{ $partner->name }}" style="width: 350px; height: auto; display: block; margin: 0 auto;">
        @else
            <img src="https://via.placeholder.com/150" class="card-img-top" alt="Image du partenaire">
        @endif
        <div class="card-body">
            <h5 class="card-title">{{ $partner->name }}</h5>
            <p class="card-text">{{ $partner->description }}</p>
            <p class="text-muted">
                <strong>Adresse:</strong> {{ $partner->address }}<br>
                <strong>Téléphone:</strong> {{ $partner->phone_number }}<br>
                <strong>Site Web:</strong> <a href="{{ $partner->website }}" target="_blank">{{ $partner->website }}</a>
            </p>
        </div>
    </div>

    <a href="{{ route('partners.template') }}" class="btn btn-secondary">Retour à la liste des partenaires</a>
</div>
@endsection
