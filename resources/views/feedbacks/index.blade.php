@extends('adminlte::page')

@section('content')
    <h1>Feedbacks</h1>



    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
<h1>?????????????????????????????????????????????????????????????????????????</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Child</th>
                <th>Activity Group</th>
                <th>Content</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($feedbacks as $feedback)
                <tr>
                    <td>{{ $feedback->child->firstname }}</td>
                    <td>{{ $feedback->activityGroup->activity->title }}</td>
                    <td>{{ $feedback->content }}</td>
                    <td>
                        <a href="{{ route('feedbacks.show', $feedback->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('feedbacks.edit', $feedback->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('feedbacks.destroy', $feedback->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
