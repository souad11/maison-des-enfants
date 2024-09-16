@extends('layouts.template')

@section('title', 'Inscription à un stage')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
    <div class="card-header" style="background-color: #FFF5F3; color: black;">
    <h2 class="mb-0">Inscription à : {{ $activityGroup->activity->title }}</h2>
    <p class="mb-0">Groupe : {{ $activityGroup->group->title }} (de {{ $activityGroup->group->min_age }} à {{ $activityGroup->group->max_age }} ans)</p>
</div>


        <div class="card-body">
            <!-- Success message -->
            @if(session('success'))
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Error message -->
            @if(session('error'))
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    {{ session('error') }}
                </div>
            @endif

            <!-- Form validation errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Registration form -->
            <form action="{{ route('registration.store') }}" method="POST">
                @csrf
                <input type="hidden" name="activity_group_id" value="{{ $activityGroup->id }}">

                <!-- Child selection dropdown -->
                <div class="form-group mb-4">
                    <label for="child_id" class="form-label">Choisir un enfant :</label>
                    <select name="child_id" id="child_id" class="form-select w-50" required>
                    <option value="" selected disabled>-- Sélectionnez un enfant --</option>
                        @foreach ($children as $child)
                            <option value="{{ $child->id }}">{{ $child->firstname }} {{ $child->lastname }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit button -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-user-plus"></i> Inscrire
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Optional: Include FontAwesome for icons -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endsection
