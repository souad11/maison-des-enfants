<!-- resources/views/tutors/create_child.blade.php -->

@extends('adminlte::page')

@section('title', 'Ajouter un Enfant')

@section('content')
<div class="container">
    <h1>Ajouter un Enfant</h1>

    {{-- Afficher les erreurs de validation --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tutors.store_child') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="firstname">Prénom:</label>
            <input type="text" class="form-control" id="firstname" name="firstname" required>
        </div>

        <div class="form-group">
            <label for="lastname">Nom de Famille:</label>
            <input type="text" class="form-control" id="lastname" name="lastname" required>
        </div>

        <div class="form-group">
            <label for="birthday">Date de Naissance:</label>
            <input type="date" class="form-control" id="birthday" name="birthday" required>
        </div>

        <div class="form-group">
            <label for="gender">Genre:</label>
            <select class="form-control" id="gender" name="gender" required>
                <option value="male">Homme</option>
                <option value="female">Femme</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
@endsection
