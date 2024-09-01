@extends('adminlte::page')  <!-- Extends the main layout -->

@section('title', 'Mon Tableau de Bord')

@section('content')
<div class="container-fluid">
    <h1>Bienvenue, {{ Auth::user()->firstname }}!</h1>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Événements à Venir</h5>
        </div>
        <div class="card-body">
            <h2>Modèle Event pas encore créé ! A FAIRE !</h2>
            <ul class="list-group">
                <li class="list-group-item">Événement 1 - 15 septembre 2024</li>
                <li class="list-group-item">Événement 2 - 22 septembre 2024</li>
                <li class="list-group-item">Événement 3 - 30 septembre 2024</li>
            </ul>
        </div>
    </div>
</div>


@endsection

