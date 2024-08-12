@extends('adminlte::page')  <!-- Extends the main layout -->

@section('title', 'Mon Tableau de Bord')

@section('content')

<div class="container-fluid">
    <h1>Bienvenue, {{ Auth::user()->firstname }}!</h1>  <!-- Exemple d'affichage du nom de l'utilisateur -->
    <p>Voici les statistiques de votre compte:</p>
    <!-- Affichage des données spécifiques à l'utilisateur -->
    <div class="row">
    <div class="col-lg-3 col-6">
        <!-- Petite carte (Small Box) -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>
                <p>Taux de Réservation</p>
            </div>
            <div class="icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <a href="#" class="small-box-footer">
                Plus d'info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- Ajoutez plus de cartes ici -->

<!-- Statistiques Rapides -->

    <div class="col-lg-3 col-6">
        <!-- Petit Carte (Small Box) -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>150</h3>
                <p>Inscriptions</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <a href="{{ url('/inscriptions') }}" class="small-box-footer">Plus d'info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- Plus de petits cartes ici -->

<div class="col-lg-3 col-6">
        <!-- Petit Carte (Small Box) -->
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>45</h3>
                <p>Enfants inscrits au mois d'avril</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <a href="{{ url('/inscriptions') }}" class="small-box-footer">Plus d'info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- Plus de petits cartes ici -->
</div>

</div>
@endsection

