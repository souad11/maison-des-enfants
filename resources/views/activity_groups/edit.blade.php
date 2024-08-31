@extends('adminlte::page')

@section('title', 'Modifier une Association Activité-Groupe')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-5 p-3 bg-light text-dark" style="border-radius: 5px;">Modifier l'Association Activité-Groupe</h1>

    <form action="{{ route('activity_groups.update', $activityGroup->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="activity_id">Activité</label>
            <select name="activity_id" id="activity_id" class="form-control">
                @foreach($activities as $activity)
                    <option value="{{ $activity->id }}" {{ $activityGroup->activity_id == $activity->id ? 'selected' : '' }}>
                        {{ $activity->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="group_id">Groupe</label>
            <select name="group_id" id="group_id" class="form-control">
                @foreach($groups as $group)
                    <option value="{{ $group->id }}" {{ $activityGroup->group_id == $group->id ? 'selected' : '' }}>
                        {{ $group->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="educator_id">Éducateur</label>
            <select name="educator_id" id="educator_id" class="form-control">
                @foreach($educators as $educator)
                    <option value="{{ $educator->id }}" {{ $activityGroup->educator_id == $educator->id ? 'selected' : '' }}>
                        {{ $educator->user->firstname }} {{ $educator->user->lastname }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="capacity">Capacité</label>
            <input type="number" name="capacity" id="capacity" class="form-control" value="{{ old('capacity', $activityGroup->capacity) }}" min="1" required>
        </div>

        <div class="form-group">
            <label for="available_space">Places Disponibles</label>
            <input type="number" name="available_space" id="available_space" class="form-control" value="{{ old('available_space', $activityGroup->available_space) }}" min="0" max="{{ $activityGroup->capacity }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
