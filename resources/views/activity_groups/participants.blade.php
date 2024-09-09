
@extends('layouts.template') 

@section('content')
    <div class="container">
        <h1>Participants of the Activity Group</h1>
        @if($children->isEmpty())
            <p>No participants found.</p>
        @else
            <ul class="list-group">
                @foreach($children as $child)
                    <li class="list-group-item">
                        {{ $child->firstname }} 
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
