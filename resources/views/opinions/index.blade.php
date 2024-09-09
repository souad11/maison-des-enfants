@extends('adminlte::page')

@section('title', 'Mes Avis')

@section('content_header')
    <h1>Mes Avis</h1>
@stop

@section('content')

    <!-- Texte d'introduction -->
    <p class="lead mb-4">
        Vous trouverez ci-dessous la liste des avis que vous avez soumis. Chaque avis est en attente de validation, approuvé ou rejeté par l'administrateur. 
        Vous pouvez consulter le statut de chaque avis et utiliser les actions disponibles pour voir ou éditer un avis si nécessaire.
    </p>

    <!-- Bouton pour créer une nouvelle opinion -->
    <div class="card">
        <div class="card-header">
            <a href="{{ route('opinions.create') }}" class="btn btn-primary">Soumettre un nouvel avis</a>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($opinions->isEmpty())
                <p>Aucun avis soumis pour le moment.</p>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Texte</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($opinions as $opinion)
                            <tr>
                                <td>{{ $opinion->id }}</td>
                                <td>{{ $opinion->texte }}</td>
                                <td>
                                    @if(is_null($opinion->is_approved))
                                        <span class="badge bg-warning">En attente</span>
                                    @elseif($opinion->is_approved)
                                        <span class="badge bg-success">Approuvé</span>
                                    @else
                                        <span class="badge bg-danger">Rejeté</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('opinions.show', $opinion->id) }}" class="btn btn-info btn-sm">Voir</a>
                                    <a href="{{ route('opinions.edit', $opinion->id) }}" class="btn btn-warning btn-sm">Éditer</a>
                                    <form action="{{ route('opinions.destroy', $opinion->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet avis ?')">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@stop
