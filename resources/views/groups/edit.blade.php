@extends('adminlte::page')

@section('title', 'Éditer un Groupe')

@section('content_header')
    <h1>Éditer le Groupe</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('groups.update', $group->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Titre :</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $group->title) }}" required>
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="min_age">Âge Minimum :</label>
                    <input type="number" class="form-control" id="min_age" name="min_age" value="{{ old('min_age', $group->min_age) }}" required>
                    @error('min_age')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="max_age">Âge Maximum :</label>
                    <input type="number" class="form-control" id="max_age" name="max_age" value="{{ old('max_age', $group->max_age) }}" required>
                    @error('max_age')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="capacity">Capacité :</label>
                    <input type="number" class="form-control" id="capacity" name="capacity" value="{{ old('capacity', $group->capacity) }}" required>
                    @error('capacity')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="available_space">Places Disponibles :</label>
                    <input type="number" class="form-control" id="available_space" name="available_space" value="{{ old('available_space', $group->available_space) }}" required>
                    @error('available_space')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="activity_ids">Activités :</label>
                    <select multiple class="form-control" id="activity_ids" name="activity_ids[]">
                        @foreach ($activities as $activity)
                            <option value="{{ $activity->id }}" {{ in_array($activity->id, $group->activities->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $activity->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('activity_ids')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Mettre à Jour</button>
            </form>
        </div>
    </div>
</div>
@stop
