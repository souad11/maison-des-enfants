@extends('adminlte::page')

@section('title', 'Modifier Activité')

@section('content')
<div class="container">
    <h1>Modifier l'Activité: {{ $activity->title }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('activities.update', $activity->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Titre:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $activity->title }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" required>{{ $activity->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="price_id">Prix:</label>
            <select class="form-control" id="price_id" name="price_id">
                @foreach ($prices as $price)
                    <option value="{{ $price->id }}" {{ $activity->price_id == $price->id ? 'selected' : '' }}>
                        {{ $price->price }} €
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="start_date">Date de début:</label>
            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $activity->start_date }}" required>
        </div>

        <div class="form-group">
            <label for="end_date">Date de fin:</label>
            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $activity->end_date }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
