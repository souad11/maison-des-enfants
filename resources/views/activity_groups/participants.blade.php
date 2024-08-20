{{-- resources/views/activity_group/participants.blade.php --}}
@extends('layouts.template') {{-- Assurez-vous d'étendre le layout que vous utilisez --}}

@section('content')
    <div class="container">
        <h1>Participants of the Activity Group</h1>
        @if($children->isEmpty())
            <p>No participants found.</p>
        @else
            <ul class="list-group">
                @foreach($children as $child)
                    <li class="list-group-item">
                        {{ $child->firstname }} {{-- Assurez-vous que 'name' est un attribut du modèle Child --}}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
