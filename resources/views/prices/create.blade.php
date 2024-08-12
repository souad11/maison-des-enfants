{{-- resources/views/prices/create.blade.php --}}
@extends('adminlte::page')

@section('title', 'Ajouter un Prix')

@section('content_header')
    <h1>Ajouter un Nouveau Prix</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('prices.store') }}">
                @csrf
                <div class="form-group">
                    <label for="type">Type d'activité</label>
                    <input type="text" name="type" id="type" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="price">Prix (€)</label>
                    <input type="number" name="price" id="price" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <a href="{{ route('prices.index') }}" class="btn btn-default">Annuler</a>
            </form>
        </div>
    </div>
@stop
