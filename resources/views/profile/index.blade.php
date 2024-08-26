@extends('adminlte::page')

@section('title', 'Profil')

@section('content_header')
    <h1>Profil de {{ $user->firstname }} {{ $user->lastname }}</h1>
@stop

@section('content')
<div class="container">
    @if(session('status') === 'profile-updated')
        <div class="alert alert-success">Profil mis à jour avec succès!</div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Informations du profil</div>
                <div class="card-body">
                    <p><strong>Prénom:</strong> {{ $user->firstname }}</p>
                    <p><strong>Nom:</strong> {{ $user->lastname }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>

                    @if ($user->role == 'educator')
                        <p><strong>Photo:</strong></p>
                        @if ($user->educator->photo)
                            <img src="{{ asset('storage/' . $user->educator->photo) }}" alt="Photo de l'éducateur" style="width: 200px;">
                        @else
                            <p>Aucune photo disponible</p>
                        @endif
                        <p><strong>Description:</strong> {{ $user->educator->description }}</p>
                    @endif

                    @if ($user->role == 'tutor')
                        <p><strong>Adresse:</strong> {{ $user->tutor->address }}</p>
                        <p><strong>Code Postal:</strong> {{ $user->tutor->postal_code }}</p>
                        <p><strong>Numéro de Téléphone:</strong> {{ $user->tutor->phone_number }}</p>
                        <p><strong>Contact d'Urgence:</strong> {{ $user->tutor->emergency_contact }}</p>
                    @endif

                    <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-primary">Modifier le profil</a>
                </div>
            </div>
        </div>
    </div>

    @if ($user->role == 'tutor')
        <div class="row justify-content-center mt-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Liste des Enfants</div>
                    <div class="card-body">
                        @if (!$children->isEmpty())
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Prénom</th>
                                        <th>Nom</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($children as $child)
                                        <tr>
                                            <td>{{ $child->firstname }}</td>
                                            <td>{{ $child->lastname }}</td>
                                            <td>
                                            <form action="{{ route('children.destroy', $child->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet enfant ?');">
                                                    Supprimer
                                                </button>
                                            </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>Aucun enfant enregistré.</p>
                        @endif
                    </div>
                </div>
                <a href="{{ route('tutors.create_child') }}" class="btn btn-success">Ajouter un enfant</a>
            </div>
        </div>
    @endif

</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Afficher le Profil!'); </script>
@stop
