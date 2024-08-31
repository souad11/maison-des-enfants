@extends('adminlte::page')


@section('content')
<div class="container">
    <h1>Liste des Groupes</h1>
    <a href="{{ route('groups.create') }}" class="btn btn-primary mb-3">Créer un Nouveau Groupe</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Âge Minimum</th>
                <th>Âge Maximum</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($groups as $group)
                <tr>
                    <td>{{ $group->id }}</td>
                    <td>{{ $group->title }}</td>
                    <td>{{ $group->min_age }}</td>
                    <td>{{ $group->max_age }}</td>
                    
                    <td>
                        <a href="{{ route('groups.show', $group->id) }}" class="btn btn-info">Voir</a>
                        <a href="{{ route('groups.edit', $group->id) }}" class="btn btn-warning">Éditer</a>
                        <form action="{{ route('groups.destroy', $group->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection