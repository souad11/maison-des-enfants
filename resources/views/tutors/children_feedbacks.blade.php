@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Feedbacks des Enfants</h1>

    @if($children->isEmpty())
        <div class="alert alert-info">
            Vous n'avez aucun enfant inscrit à des activités.
        </div>
    @else
        @foreach($children as $child)
            <h2>{{ $child->firstname }} {{ $child->lastname }}</h2>

            @if($child->feedbacks->isEmpty())
                <div class="alert alert-warning">
                    Aucun feedback disponible pour cet enfant.
                </div>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Activité</th>
                            <th>Groupe</th>
                            <th>Feedback</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($child->feedbacks as $feedback)
                            <tr>
                                <td>{{ $feedback->activityGroup->activity->title }}</td>
                                <td>{{ $feedback->activityGroup->group->title }}</td>
                                <td>{{ $feedback->content }}</td>
                               
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        @endforeach
    @endif
</div>
@endsection
