@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Détails du Partenaire</h1>

    <div class="card">
        <div class="card-header">
            {{ $partner->name }}
        </div>
        <div class="card-body">
            <p><strong>Description:</strong> {{ $partner->description }}</p>
            <p><strong>Adresse:</strong> {{ $partner->address }}</p>
            <p><strong>Numéro de Téléphone:</strong> {{ $partner->phone_number }}</p>
            <p><strong>Site Web:</strong> <a href="{{ $partner->website }}" target="_blank">{{ $partner->website }}</a></p>
            @if ($partner->picture)
                <img src="{{ asset('storage/' . $partner->picture) }}" alt="Image du Partenaire" style="width: 150px;">
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ route('partners.edit', $partner->id) }}" class="btn btn-warning">Modifier</a>
            <form action="{{ route('partners.destroy', $partner->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce partenaire ?');">Supprimer</button>
            </form>
        </div>
    </div>

    <a href="{{ route('partners.index') }}" class="btn btn-secondary mt-3">Retour à la Liste</a>
</div>
@endsection
