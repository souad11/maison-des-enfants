@extends('adminlte::page')

@section('title', 'Créer une activité')

@section('content_header')
    <h1>Créer une nouvelle activité</h1>
@stop

@section('content')

<div class="container">
    

    <!-- Affichage des erreurs de validation -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('activities.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="price_id">Prix</label>
            <select class="form-control @error('price_id') is-invalid @enderror" id="price_id" name="price_id" required>
                @foreach ($prices as $price)
                    <option value="{{ $price->id }}" {{ old('price_id') == $price->id ? 'selected' : '' }}>
                        {{ $price->price }}
                    </option>
                @endforeach
            </select>
            @error('price_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
         <!-- Ajout du champ Type -->
         <div class="form-group">
            <label for="type">Type</label>
            <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" required>
                <option value="">-- Sélectionnez le type --</option>
                <option value="annuel" {{ old('type') == 'annuel' ? 'selected' : '' }}>Activités à l'année</option>
                <option value="hebdomadaire" {{ old('type') == 'hebdomadaire' ? 'selected' : '' }}>Activités hebdomadaires</option>
            </select>
            @error('type')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" required>{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="start_date">Date de début</label>
            <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
            @error('start_date')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="end_date">Date de fin</label>
            <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date') }}" required>
            @error('end_date')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>

@endsection
