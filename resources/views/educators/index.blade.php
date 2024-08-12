<!-- resources/views/educator/dashboard.blade.php -->

@extends('adminlte::page')

@section('title', 'Mon Dashboard')

@section('content')
    <div class="container-fluid">
        <h1>Dashboard</h1>
        <h2>Liste des Éducateurs</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($educators as $index => $educator)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $educator->user->firstname }}</td>
                        <td>{{ $educator->user->lastname }}</td>
                       
                        <td>
                             <!-- Bouton Afficher -->
                             <a href="{{ route('educators.show', $educator->id) }}" class="btn btn-sm btn-info" style="margin-right: 5px;">Afficher</a>
                            
                            <form action="{{ route('educators.destroy', $educator->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet éducateur ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Bouton pour ajouter un éducateur -->
        <a href="{{ route('educators.create') }}" class="btn btn-primary mt-3">Ajouter un Éducateur</a>
    </div>
@endsection
