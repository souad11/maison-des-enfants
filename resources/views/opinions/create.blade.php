<!-- resources/views/opinions/create.blade.php -->
@extends('adminlte::page')

@section('title', 'Créer une Opinion')

@section('content_header')
    <h1>Créer une Nouvelle Opinion</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('opinions.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="texte">Texte de l'Opinion</label>
                    <textarea name="texte" id="texte" class="form-control @error('texte') is-invalid @enderror" rows="4" required>{{ old('texte') }}</textarea>
                    @error('texte')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                

                <button type="submit" class="btn btn-primary">Créer l'Opinion</button>
                <a href="{{ route('opinions.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
@stop
