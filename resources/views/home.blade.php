@extends('layouts.template')

@section('content')


    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
            <div class="owl-carousel header-carousel position-relative">
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="img/carousel-2.jpg" alt="">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(0, 0, 0, .2);">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-10 col-lg-8">
                                    <h1 class="display-2 text-white animated slideInDown mb-4">Le meilleur lieu d'accueil pour vos enfants</h1>
                                    <p class="fs-5 fw-medium text-white mb-4 pb-2">Découvrez nos activités extrascolaires enrichissantes, idéales pour stimuler le développement des enfants âgés de 3 à 12 ans.</p>
                                    <a href="" class="btn btn-primary rounded-pill py-sm-3 px-sm-5 me-3 animated slideInLeft">Inscrivez-vous</a>
                                    <a href="" class="btn btn-dark rounded-pill py-sm-3 px-sm-5 animated slideInRight">Contactez-nous</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="img/carousel-2.jpg" alt="">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(0, 0, 0, .2);">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-10 col-lg-8">
                                    <h1 class="display-2 text-white animated slideInDown mb-4">Make A Brighter Future For Your Child</h1>
                                    <p class="fs-5 fw-medium text-white mb-4 pb-2">Vero elitr justo clita lorem. Ipsum dolor at sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea elitr.</p>
                                    <a href="" class="btn btn-primary rounded-pill py-sm-3 px-sm-5 me-3 animated slideInLeft">Learn More</a>
                                    <a href="" class="btn btn-dark rounded-pill py-sm-3 px-sm-5 animated slideInRight">Our Classes</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
        <!-- Carousel End -->

        <!-- Facilities Start -->
        <div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3">Nos Activités</h1>
            <p>Nous proposons une variété d'activités hebdomadaires et annuelles pour le développement et le divertissement des enfants, y compris des sessions spéciales le samedi.</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="facility-item">
                    <div class="facility-icon bg-primary">
                        <span class="bg-primary"></span>
                        <i class="fa fa-basketball-ball fa-3x text-primary"></i>
                        <span class="bg-primary"></span>
                    </div>
                    <div class="facility-text bg-primary">
                        <h3 class="text-primary mb-3">Sport</h3>
                        <p class="mb-0">Des activités sportives variées pour encourager l'exercice physique et la compétition amicale.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="facility-item">
                    <div class="facility-icon bg-success">
                        <span class="bg-success"></span>
                        <i class="fa fa-paint-brush fa-3x text-success"></i>
                        <span class="bg-success"></span>
                    </div>
                    <div class="facility-text bg-success">
                        <h3 class="text-success mb-3">Art et Créativité</h3>
                        <p class="mb-0">Ateliers artistiques pour stimuler la créativité et l'expression personnelle des enfants.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="facility-item">
                    <div class="facility-icon bg-warning">
                        <span class="bg-warning"></span>
                        <i class="fa fa-code fa-3x text-warning"></i>
                        <span class="bg-warning"></span>
                    </div>
                    <div class="facility-text bg-warning">
                        <h3 class="text-warning mb-3">Technologie et Coding</h3>
                        <p class="mb-0">Sessions de codage et d'initiation à la technologie pour préparer les enfants au monde numérique.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                <div class="facility-item">
                    <div class="facility-icon bg-info">
                        <span class="bg-info"></span>
                        <i class="fa fa-heart fa-3x text-info"></i>
                        <span class="bg-info"></span>
                    </div>
                    <div class="facility-text bg-info">
                        <h3 class="text-info mb-3">Développement Personnel</h3>
                        <p class="mb-0">Activités visant à renforcer la confiance en soi et les compétences interpersonnelles.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        <!-- Facilities End -->


        <!-- Upcoming Events Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-3">Événements à Venir</h1>
                <p>Ne manquez pas nos prochains événements pour vos enfants.</p>
            </div>
            <div class="row g-4">
                @forelse($upcomingEvents as $event)
                <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="event-item bg-light rounded p-4">
                        @if($event->photo)
                            <div class="mb-3 text-center">
                                <img src="{{ asset('storage/public/events/' . $event->photo) }}" alt="{{ $event->title }}" class="img-fluid rounded">
                            </div>
                        @endif
                        <h5 class="mb-1">{{ $event->title }}</h5>
                        <small>{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y H:i') }}</small>
                        <p class="mb-0">{{ $event->description }}</p>
                    </div>
                </div>

                @empty
                    <div class="col-12">
                        <p class="text-center">Aucun événement à venir pour le moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <!-- Upcoming Events End -->


        <!-- Opinions des parents Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-3">Avis des Parents</h1>
                <p>Découvrez ce que les parents disent de nos activités et de l'impact positif qu'elles ont sur le développement de leurs enfants.</p>
            </div>
            <div class="row g-4">
                @forelse($parentOpinions as $opinion)
                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="testimonial-item bg-light rounded p-4">
                            <div class="mb-3">
                                <h5 class="mb-1">{{ $opinion->tutor->user->firstname }} {{ $opinion->tutor->user->lastname }}</h5>
                                <small>Posté le {{ \Carbon\Carbon::parse($opinion->date_posted)->format('d M Y H:i') }}</small>
                            </div>
                            <p class="mb-0">{{ $opinion->texte }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-center">Aucun avis pour le moment.</p>
                @endforelse
            </div>
        </div>
    </div>
    <!-- Opinions des parents End -->


@endsection