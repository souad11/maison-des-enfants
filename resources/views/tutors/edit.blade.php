@extends('adminlte::page')

@section('title', 'Modifier un Tuteur')

@section('content_header')
    <h1>Modifier un Tuteur</h1>
@stop

@section('content')
    <div class="container">
        <!-- Afficher les erreurs de validation -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulaire de modification d'un tuteur -->
        <form action="{{ route('tutors.update', $tutor->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Prénom -->
            <div class="form-group">
                <label for="firstname">Prénom</label>
                <input type="text" name="firstname" class="form-control" id="firstname" value="{{ old('firstname', $tutor->user->firstname) }}" required>
            </div>

            <!-- Nom de famille -->
            <div class="form-group">
                <label for="lastname">Nom de famille</label>
                <input type="text" name="lastname" class="form-control" id="lastname" value="{{ old('lastname', $tutor->user->lastname) }}" required>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $tutor->user->email) }}" required>
            </div>

            <!-- Numéro de téléphone -->
            <div class="form-group">
                <label for="phone_number">Numéro de téléphone</label>
                <input type="text" name="phone_number" class="form-control" id="phone_number" value="{{ old('phone_number', $tutor->phone_number) }}">
            </div>

            <!-- Adresse -->
            <div class="form-group">
                <label for="address">Adresse</label>
                <input type="text" name="address" class="form-control" id="address" value="{{ old('address', $tutor->address) }}">
            </div>

            <!-- Code Postal -->
            <div class="form-group">
                <label for="postal_code">Code Postal</label>
                <input type="text" name="postal_code" class="form-control" id="postal_code" value="{{ old('postal_code', $tutor->postal_code) }}">
            </div>

            <!-- Contact d'urgence -->
            <div class="form-group">
                <label for="emergency_contact">Contact d'Urgence</label>
                <input type="text" name="emergency_contact" class="form-control" id="emergency_contact" value="{{ old('emergency_contact', $tutor->emergency_contact) }}">
            </div>

            <!-- Bouton de soumission -->
            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
            <a href="{{ route('tutors.admin') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@stop

@section('css')
    <style>
        /* Styles personnalisés pour améliorer l'affichage */
        .container {
            margin-top: 20px;
        }
        .form-group label {
            font-weight: bold;
        }
    </style>
@stop
