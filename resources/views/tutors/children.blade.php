@extends('adminlte::page')

@section('title', 'Mes Enfants')

@section('content_header')
    <h1>Mes Enfants</h1>
@stop

@section('content')
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            @if (count($children) > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Date de Naissance</th>
                            <th>Genre</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($children as $child)
                            <tr>
                                <td>{{ $child->firstname }}</td>
                                <td>{{ $child->lastname }}</td>
                                
                                <td>{{ (new DateTime($child->birthday))->format('d/m/Y') }}</td>
                                <td>{{ $child->gender === 'male' ? 'Masculin' : 'Féminin' }}</td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Aucun enfant n'a été trouvé.</p>
            @endif
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Liste des Enfants!'); </script>
@stop
