@extends('adminlte::page')

@section('title', 'Gestion des Opinions')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-5 p-3 bg-light text-dark" style="border-radius: 5px;">Gestion des Opinions</h1>

    <!-- Formulaire de filtrage -->
    <div class="mb-4">
        <form action="{{ route('opinions.indexAdmin') }}" method="GET" class="form-inline">
            <label for="status" class="mr-2">Filtrer par statut :</label>
            <select name="status" id="status" class="form-control mr-2">
                <option value="all" {{ $filterStatus == 'all' ? 'selected' : '' }}>Tous</option>
                <option value="approved" {{ $filterStatus == 'approved' ? 'selected' : '' }}>Approuvés</option>
                <option value="rejected" {{ $filterStatus == 'rejected' ? 'selected' : '' }}>Rejetés</option>
                <option value="pending" {{ $filterStatus == 'pending' ? 'selected' : '' }}>Non traités</option> <!-- Ajout du filtre Non traité -->
            </select>
            <button type="submit" class="btn btn-primary">Filtrer</button>
        </form>
    </div>

    @if($opinions->isEmpty())
        <div class="alert alert-info text-center">
            Aucune opinion trouvée pour ce filtre.
        </div>
    @else
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom du Tuteur</th>
                    <th>Texte</th>
                    <th>Statut</th>
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
                            @if(is_null($opinion->is_approved))
                                <span class="badge badge-warning">Non traité</span>
                            @elseif($opinion->is_approved)
                                <span class="badge badge-success">Approuvé</span>
                            @else
                                <span class="badge badge-danger">Rejeté</span>
                            @endif
                        </td>
                        <td>
                            <!-- Formulaires pour approuver ou rejeter -->
                            @if(is_null($opinion->is_approved)) <!-- Afficher les boutons si non traité -->
                                <form action="{{ route('admin.opinions.approve', $opinion->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Approuver</button>
                                </form>
                                <form action="{{ route('admin.opinions.reject', $opinion->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Rejeter</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
