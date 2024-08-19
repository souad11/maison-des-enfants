@extends('layouts.template')


@section('content')
     <!-- Team Start -->
     <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-3">Nos Éducateurs</h1>
                <p>Découvrez notre équipe dévouée d'éducateurs.</p>
            </div>
            <div class="row g-4">
                @foreach($educators as $educator)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item position-relative">
                        <img class="img-fluid rounded-circle w-75" src="{{ asset('img/' . $educator->photo) }}" alt="{{ $educator->user->firstname }} {{ $educator->user->lastname }}">
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
