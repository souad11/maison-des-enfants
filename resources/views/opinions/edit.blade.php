@extends('adminlte::page')

@section('title', 'Modifier l\'Opinion')

@section('content_header')
    <h1>Modifier l'Opinion</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Modifier l'Opinion #{{ $opinion->id }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('opinions.update', $opinion) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="texte">Texte de l'Opinion</label>
                    <textarea id="texte" name="texte" class="form-control" rows="4">{{ old('texte', $opinion->texte) }}</textarea>
                    @error('texte')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                    <a href="{{ route('opinions.index') }}" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
@stop
