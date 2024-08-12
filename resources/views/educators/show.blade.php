{{-- resources/views/educators/show.blade.php --}}

@extends('adminlte::page')

@section('title', 'Détails de l\'Éducateur')

@section('content')
<div class="container mt-4">
    <h1>{{ $educator->user->firstname }} {{ $educator->user->lastname }}</h1>
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('photos/' . $educator->photo) }}" alt="Photo de l'éducateur" class="img-fluid mb-3">
        </div>
        <div class="col-md-6">
            <h3>Description</h3>
            <p>{{ $educator->description }}</p>
        </div>
    </div>
    <a href="{{ route('educators.index') }}" class="btn btn-secondary mt-3">Retour à la Liste</a>
</div>
@endsection
