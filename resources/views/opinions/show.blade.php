@extends('adminlte::page')

@section('title', 'Détails de l\'Opinion')

@section('content_header')
    <h1>Détails de l'Opinion</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Opinion #{{ $opinion->id }}</h3>
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9">{{ $opinion->id }}</dd>

                <dt class="col-sm-3">Texte</dt>
                <dd class="col-sm-9">{{ $opinion->texte }}</dd>

                <dt class="col-sm-3">Date de Création</dt>
                <dd class="col-sm-9">{{ $opinion->created_at->format('d/m/Y H:i') }}</dd>

                <dt class="col-sm-3">Date de Mise à Jour</dt>
                <dd class="col-sm-9">{{ $opinion->updated_at->format('d/m/Y H:i') }}</dd>
            </dl>
        </div>
        <div class="card-footer">
            <a href="{{ route('opinions.index') }}" class="btn btn-secondary">Retour à la Liste</a>
            <a href="{{ route('opinions.edit', $opinion) }}" class="btn btn-primary">Modifier</a>

            <form action="{{ route('opinions.destroy', $opinion) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
        </div>
    </div>
@stop
