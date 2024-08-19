@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Associer une Activité à un Groupe</h1>

    <form action="{{ route('activity_groups.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="activity_id">Activité</label>
        <select name="activity_id" id="activity_id" class="form-control" required>
            @foreach($activities as $activity)
                <option value="{{ $activity->id }}">{{ $activity->title }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="group_id">Groupe</label>
        <select name="group_id" id="group_id" class="form-control" required>
            @foreach($groups as $group)
                <option value="{{ $group->id }}">{{ $group->title }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="educator_id">Éducateur</label>
        <select name="educator_id" id="educator_id" class="form-control" required>
            @foreach($educators as $educator)
                <option value="{{ $educator->id }}">{{ $educator->user->firstname }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Créer l'Association</button>
</form>

</div>
@endsection
