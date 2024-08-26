@extends('adminlte::page')

@section('title', 'Modifier le Profil')

@section('content_header')
    <h1>Modifier le Profil</h1>
@stop

@section('content')
    @if (session('status') === 'profile-updated')
        <div class="alert alert-success">Profil mis à jour avec succès!</div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div class="mb-3">
                    <label for="firstname" class="form-label">Prénom</label>
                    <input type="text" name="firstname" id="firstname" class="form-control" value="{{ old('firstname', $user->firstname) }}" required>
                </div>

                <div class="mb-3">
                    <label for="lastname" class="form-label">Nom</label>
                    <input type="text" name="lastname" id="lastname" class="form-control" value="{{ old('lastname', $user->lastname) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>

                @if ($user->role == 'tutor')
                    <div class="mb-3">
                        <label for="address" class="form-label">Adresse</label>
                        <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $user->tutor->address) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="postal_code" class="form-label">Code Postal</label>
                        <input type="text" name="postal_code" id="postal_code" class="form-control" value="{{ old('postal_code', $user->tutor->postal_code) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Numéro de Téléphone</label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number', $user->tutor->phone_number) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="emergency_contact" class="form-label">Contact d'Urgence</label>
                        <input type="text" name="emergency_contact" id="emergency_contact" class="form-control" value="{{ old('emergency_contact', $user->tutor->emergency_contact) }}" required>
                    </div>
                @endif

                @if ($user->role == 'educator')
                    <div class="mb-3">
                        <label for="photo" class="form-label">Photo de Profil</label>
                        <input type="file" name="photo" id="photo" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control">{{ old('description', $user->educator->description ?? '') }}</textarea>
                    </div>
                @endif

                <button type="submit" class="btn btn-primary">Mettre à Jour</button>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Modifier le Profil!'); </script>
@stop
