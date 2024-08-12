{{-- resources/views/prices/edit.blade.php --}}
@extends('adminlte::page')

@section('title', 'Modifier le Prix')

@section('content_header')
    <h1>Modifier le Prix</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('prices.update', $price->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="type">Type d'activité</label>
                    <input type="text" name="type" id="type" value="{{ $price->type }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="price">Prix (€)</label>
                    <input type="number" name="price" id="price" value="{{ $price->price }}" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                <a href="{{ route('prices.index') }}" class="btn btn-default">Annuler</a>
            </form>
        </div>
    </div>
@stop
