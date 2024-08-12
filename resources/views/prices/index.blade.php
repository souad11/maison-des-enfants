{{-- resources/views/prices/index.blade.php --}}
@extends('adminlte::page')

@section('title', 'Liste des Prix')

@section('content_header')
    <h1>Liste des Prix</h1>
@stop

@section('content')
<div class="row" style="margin-bottom: 25px;">
    <div class="col-12 mb-2" >
        <!-- Bouton directement sous le titre -->
        <a href="{{ route('prices.create') }}" class="btn btn-primary">Ajouter un Nouveau Prix</a>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Prix</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($prices as $price)
                <tr>
                    <td>{{ $price->type }}</td>
                    <td>{{ $price->price }}€</td>
                    <td>
                        <a href="{{ route('prices.edit', $price->id) }}" class="btn btn-xs btn-warning">Modifier</a>
                        <form action="{{ route('prices.destroy', $price->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce prix ?');" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-xs btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop
