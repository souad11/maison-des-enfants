@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Créer un Nouveau Groupe</h1>

    <form action="{{ route('groups.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Titre du Groupe</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="min_age">Âge Minimum</label>
            <input type="number" name="min_age" id="min_age" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="max_age">Âge Maximum</label>
            <input type="number" name="max_age" id="max_age" class="form-control" required>
        </div>


        <button type="submit" class="btn btn-primary">Créer le Groupe</button>
    </form>
</div>
@endsection
