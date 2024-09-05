@extends('adminlte::page')

@section('title', 'Gestion des Opinions')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-5 p-3 bg-light text-dark" style="border-radius: 5px;">Gestion des Opinions</h1>

    @if($opinions->isEmpty())
        <div class="alert alert-info text-center">
            Aucune opinion en attente de validation.
        </div>
    @else
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom du Tuteur</th>
                    <th>Texte</th>
                    <th>Gestion</th>
                </tr>
            </thead>
            <tbody>
            @foreach($opinions as $opinion)
    <tr>
        <td>{{ $opinion->id }}</td>
        <td>{{ $opinion->tutor->user->firstname }} {{ $opinion->tutor->user->lastname }}</td>
        <td>{{ $opinion->texte }}</td>
        <td>
        @if($opinion->is_approved === null)
            <!-- Formulaire pour approuver -->
            <form action="{{ route('admin.opinions.approve', $opinion->id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-success btn-sm">Approuver</button>
            </form>

            <!-- Formulaire pour rejeter -->
            <form action="{{ route('admin.opinions.reject', $opinion->id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">Rejeter</button>
            </form>
        @elseif($opinion->is_approved)
            <span class="badge bg-success text-light">Approuvé</span>
        @else
            <span class="badge bg-danger text-light">Rejeté</span>
        @endif

        </td>
    </tr>
@endforeach

            </tbody>
        </table>
    @endif
</div>
@endsection
