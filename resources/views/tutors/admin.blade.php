@extends('adminlte::page')

@section('title', 'Tuteurs et Enfants')

@section('content_header')
    <h1>Tuteurs et leurs Enfants</h1>
@stop

@section('content')
    <div class="container">
        <!-- Formulaire de recherche -->
        <form action="{{ route('tutors.admin') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Rechercher par nom ou prénom" value="{{ request('search') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Rechercher</button>
                </div>
            </div>
        </form>
        @if($tutors->isEmpty())
            <div class="alert alert-warning text-center">
                <strong>Aucun tuteur trouvé.</strong>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="thead">
                        <tr>
                            <th>Nom du Tuteur</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Adresse</th>
                            <th>Code Postal</th>
                            <th>Contact d'Urgence</th>
                            <th>Enfants</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tutors as $tutor)
                            <tr>
                                <td>{{ $tutor->user->firstname }} {{ $tutor->user->lastname }}</td>
                                <td>{{ $tutor->user->email }}</td>
                                <td>{{ $tutor->phone_number ?? 'Non renseigné' }}</td>
                                <td>{{ $tutor->address ?? 'Non renseignée' }}</td>
                                <td>{{ $tutor->postal_code ?? 'Non renseigné' }}</td>
                                <td>{{ $tutor->emergency_contact ?? 'Non renseigné' }}</td>
                                <td>
                                    @if($tutor->children->isEmpty())
                                        <span class="badge badge-danger">Aucun enfant</span>
                                    @else
                                        <ul class="list-unstyled mb-0">
                                            @foreach($tutor->children as $child)
                                                <li>{{ $child->firstname }} {{ $child->lastname }} 
                                                    <small class="text-muted">(Né le {{ \Carbon\Carbon::parse($child->birthday)->format('d/m/Y') }})</small>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@stop

@section('css')
    <style>
        /* Custom styles for a simple and elegant look */
        .table {
            margin-top: 20px;
        }
        th, td {
            text-align: center;
            vertical-align: middle;
        }
        .badge-danger {
            background-color: #e74c3c;
            color: white;
            padding: 5px;
            border-radius: 5px;
        }
        ul {
            padding-left: 0;
            list-style-type: none;
        }
        ul li {
            padding: 5px 0;
        }
    </style>
@stop
