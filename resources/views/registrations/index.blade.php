@extends('adminlte::page')

@section('title', 'Historique des Inscriptions')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-5 p-3 bg-light text-dark" style="border-radius: 5px;">Historique des Inscriptions</h1>
    
    @if($registrations->isEmpty())
        <div class="alert alert-info text-center">
            Aucune inscription disponible.
        </div>
    @else
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom de l'Enfant</th>
                    <th>Semaine d'activité</th>
                    <th>Date d'Inscription</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registrations as $registration)
                    <tr>
                        <td>{{ $registration->id }}</td>
                        <td>{{ $registration->child->firstname }}</td>
                        <td>{{ $registration->activityGroup->activity->title }}</td>
                        <td>{{ $registration->created_at->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge 
                            @if($registration->status == 'paid') 
                                bg-success text-light 
                            @elseif($registration->status == 'pending') 
                                bg-warning text-dark 
                            @else 
                                bg-danger text-light 
                            @endif">
                                {{ $registration->status }}
                            </span>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
