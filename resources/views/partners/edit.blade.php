@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Modifier Partenaire</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $partner->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description">{{ old('description', $partner->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Adresse</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $partner->address) }}">
        </div>

        <div class="mb-3">
            <label for="phone_number" class="form-label">Numéro de Téléphone</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $partner->phone_number) }}">
        </div>

        <div class="mb-3">
            <label for="website" class="form-label">Site Web</label>
            <input type="text" class="form-control" id="website" name="website" value="{{ old('website', $partner->website) }}">
        </div>

        <div class="mb-3">
            <label for="picture" class="form-label">Image</label>
            <input type="file" class="form-control" id="picture" name="picture">
            @if ($partner->picture)
                <img src="{{ asset('storage/' . $partner->picture) }}" alt="Image du Partenaire" class="mt-2" style="width: 150px;">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
    </form>
</div>
@endsection
