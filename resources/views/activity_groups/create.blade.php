@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Nouveau stage</h1>

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
                    <option value="{{ $educator->id }}">{{ $educator->user->firstname }} {{ $educator->user->lastname }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="capacity">Capacité</label>
            <input type="number" name="capacity" id="capacity" class="form-control" value="{{ old('capacity') }}" min="1" required>
        </div>

        <div class="form-group">
            <label for="available_space">Places Disponibles</label>
            <input type="number" name="available_space" id="available_space" class="form-control" value="{{ old('available_space') }}" min="0" required>
        </div>

        <button type="submit" class="btn btn-primary">Créer le stage</button>
    </form>
</div>
@endsection
