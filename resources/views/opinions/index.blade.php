<!-- resources/views/opinions/index.blade.php -->
@extends('adminlte::page')

@section('title', 'Opinions')

@section('content_header')
    <h1>Liste des Opinions</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('opinions.create') }}" class="btn btn-primary">Créer une nouvelle opinion</a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($opinions->isEmpty())
                <p>Aucune opinion trouvée.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Texte</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($opinions as $opinion)
                            <tr>
                                <td>{{ $opinion->id }}</td>
                                <td>{{ $opinion->texte }}</td>
                                <td>
                                    <a href="{{ route('opinions.show', $opinion->id) }}" class="btn btn-info btn-sm">Voir</a>
                                    <a href="{{ route('opinions.edit', $opinion->id) }}" class="btn btn-warning btn-sm">Éditer</a>
                                    <form action="{{ route('opinions.destroy', $opinion->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette opinion ?')">Supprimer</button>
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
