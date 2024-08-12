<!-- resources/views/educators/create.blade.php -->

@extends('adminlte::page')

@section('title', 'Ajouter un Éducateur')

@section('content')
    <div class="container mt-4">
        <h1>Ajouter un Éducateur</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('educators.store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="firstname">Prénom:</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" required>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Nom:</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="langue">Langue:</label>
                        <select class="form-control" id="langue" name="langue" required>
                            <option value="fr">Français</option>
                            <option value="en">Anglais</option>
                            <!-- Ajoutez d'autres options de langue ici -->
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
