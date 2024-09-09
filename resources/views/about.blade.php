@extends('layouts.template')

@section('content')

    <!-- Page Header End -->
    <div class="container-xxl py-5 page-header position-relative mb-5">
        <div class="container py-5">
            <h1 class="display-2 text-white animated slideInDown mb-4">A propos</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">A propos</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <h1 class="mb-4">Découvrez La Maison des Enfants et Nos Stages d'activités</h1>
                <p>Bienvenue à La Maison des Enfants, un lieu chaleureux et accueillant situé au cœur de Saint-Gilles. Nous offrons un environnement stimulant pour les enfants de 4 à 12 ans, où ils peuvent s'épanouir à travers diverses activités extrascolaires.</p>
                <p class="mb-4">Nos programmes sont conçus pour nourrir la curiosité et la créativité des enfants, que ce soit pendant les semaines de vacances ou tout au long de l'année. Chaque samedi après-midi, nous organisons des activités passionnantes et éducatives, permettant aux enfants de découvrir de nouvelles passions et de développer leurs compétences.</p>
                    <div class="row g-4 align-items-center">
                        <div class="col-sm-6">
                        <a class="btn btn-primary rounded-pill py-3 px-5" href="{{ route('register') }}">Inscrivez-vous</a>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-6 about-img wow fadeInUp" data-wow-delay="0.5s">
                    <div class="row">
                        <div class="col-12 text-center">
                            <img class="img-fluid w-75 rounded-circle bg-light p-3" src="img/about-1.jpg" alt="">
                        </div>
                        <div class="col-6 text-start" style="margin-top: -150px;">
                            <img class="img-fluid w-100 rounded-circle bg-light p-3" src="img/about-2.jpg" alt="">
                        </div>
                        <div class="col-6 text-end" style="margin-top: -150px;">
                            <img class="img-fluid w-100 rounded-circle bg-light p-3" src="img/about-3.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

@endsection