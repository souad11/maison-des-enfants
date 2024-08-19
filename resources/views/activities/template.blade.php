@extends('layouts.template')

@section('title', 'Nos Activités')

@section('content')
<div class="container">
    <h1>Nos Activités</h1>

    @if($activities->isEmpty())
        <p>Aucune activité disponible pour le moment.</p>
    @else
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Titre</th>
                    <th scope="col">Description</th>
                    <th scope="col">Date de début</th>
                    <th scope="col">Date de fin</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activities as $activity)
                    <tr>
                        <td>{{ $activity->title }}</td>
                        <td>{{ $activity->description }}</td>
                        <td>{{ \Carbon\Carbon::parse($activity->start_date)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($activity->end_date)->format('d/m/Y') }}</td>
                        <td>
                        @if (Auth::user()->role == 'tutor')
                                <a href="{{ route('activities.register', $activity->id) }}" class="btn btn-primary">Inscrire son enfant</a>
                            @else
                                <p>Connectez-vous pour inscrire votre enfant</p>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif



</div>
@endsection
