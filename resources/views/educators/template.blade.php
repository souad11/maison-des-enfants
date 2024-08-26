@extends('layouts.template')

@section('content')
     <!-- Team Start -->
     <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <!-- Appliquer le même style que pour "Nos Activités" -->
                <h1 class="text-center mb-5 p-3 bg-light text-dark" style="border-radius: 5px;">Nos Éducateurs</h1>
                <p>Découvrez notre équipe dévouée d'éducateurs.</p>
            </div>
            <div class="row g-4">
                @foreach($educators as $educator)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item position-relative">
                            <img class="img-fluid rounded-circle w-75" src="{{ asset('storage/' . $educator->photo) }}" alt="{{ $educator->user->firstname }} {{ $educator->user->lastname }}">
                            <div class="team-text">
                                <h3>{{ $educator->user->firstname }} {{ $educator->user->lastname }}</h3>
                                <p>{{ $educator->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Team End -->
@endsection
