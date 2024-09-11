@extends('adminlte::page')

@section('content')
<div class="container">
<h1>Envoyez un nouveau message à l'un de vos contacts

</h1>

    <div class="card">
        <div class="card-body">
            @if($users->isEmpty())
                <p>Aucun utilisateur disponible pour démarrer une conversation.</p>
            @else
                <!-- Séparer les utilisateurs par rôle -->
                @php
                    $admins = $users->where('role', 'admin');
                    $educators = $users->where('role', 'educator');
                    $tutors = $users->where('role', 'tutor');
                @endphp

                <!-- Liste déroulante pour les administrateurs -->
                @if($admins->isNotEmpty())
                    <div class="mb-3">
                        <label for="adminSelect">Administrateurs</label>
                        <select id="adminSelect" class="form-control" onchange="location = this.value;">
                            <option value="">Sélectionner un administrateur</option>
                            @foreach($admins as $user)
                                <option value="{{ route('message.index', $user->id) }}">
                                    {{ $user->firstname }} {{ $user->lastname }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <!-- Liste déroulante pour les éducateurs -->
                @if($educators->isNotEmpty())
                    <div class="mb-3">
                        <label for="educatorSelect">Animateurs</label>
                        <select id="educatorSelect" class="form-control" onchange="location = this.value;">
                            <option value="">Sélectionner un animateur</option>
                            @foreach($educators as $user)
                                <option value="{{ route('message.index', $user->id) }}">
                                    {{ $user->firstname }} {{ $user->lastname }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <!-- Liste déroulante pour les tuteurs -->
                @if($tutors->isNotEmpty())
                    <div class="mb-3">
                        <label for="tutorSelect">Parents</label>
                        <select id="tutorSelect" class="form-control" onchange="location = this.value;">
                            <option value="">Sélectionner un parent</option>
                            @foreach($tutors as $user)
                                <option value="{{ route('message.index', $user->id) }}">
                                    {{ $user->firstname }} {{ $user->lastname }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection
