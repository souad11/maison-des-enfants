@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Partenaires</h1>
    <a href="{{ route('partners.create') }}" class="btn btn-primary mb-3">Ajouter un Partenaire</a>
    
    @if ($partners->isEmpty())
        <p>Aucun partenaire trouvé.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Adresse</th>
                    <th>Numéro de Téléphone</th>
                    <th>Site Web</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($partners as $partner)
                    <tr>
                        <td>{{ $partner->name }}</td>
                        <td>{{ $partner->description }}</td>
                        <td>{{ $partner->address }}</td>
                        <td>{{ $partner->phone_number }}</td>
                        <td><a href="{{ $partner->website }}" target="_blank">{{ $partner->website }}</a></td>
                        <td>
                            <a href="{{ route('partners.show', $partner->id) }}" class="btn btn-info btn-sm">Voir</a>
                            <a href="{{ route('partners.edit', $partner->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('partners.destroy', $partner->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce partenaire ?');">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
