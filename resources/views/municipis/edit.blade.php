@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-3">
        <a href="{{ route('municipis.provincies') }}" class="btn btn-secondary">Darrere</a>
    </div>

    <div class="w-full">
        <div class="flex flex-wrap">
            <h1 class="mb-5">Editar Municipi: {{ $municipi->nom }}</h1>
        </div>
    </div>

    <form method="POST" action="{{ route('municipis.update', $municipi->id) }}" enctype="multipart/form-data"> @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom" class="form-label">{{ __("Nom") }}</label>
            <input name="nom" type="text" class="form-control" value="{{ old('nom', $municipi->nom) }}">
            @error('nom')
            <div class="fs-6 text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="descripcio" class="form-label">{{ __("Descripció") }}</label>
            <textarea name="descripcio" class="form-control">{{ old('descripcio', $municipi->descripcio) }}</textarea>
            @error('descripcio')
            <div class="fs-6 text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="comarca" class="form-label">{{ __("Comarca") }}</label>
            <input name="comarca" type="text" class="form-control" value="{{ old('comarca', $municipi->comarca) }}">
            @error('comarca')
            <div class="fs-6 text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="provincia" class="form-label">{{ __("Província") }}</label>
            <select name="provincia" class="form-select">
                <option value="Girona" {{ old('provincia', $municipi->provincia) == 'Girona' ? 'selected' : '' }}>Girona</option>
                <option value="Barcelona" {{ old('provincia', $municipi->provincia) == 'Barcelona' ? 'selected' : '' }}>Barcelona</option>
                <option value="Tarragona" {{ old('provincia', $municipi->provincia) == 'Tarragona' ? 'selected' : '' }}>Tarragona</option>
                <option value="Lleida" {{ old('provincia', $municipi->provincia) == 'Lleida' ? 'selected' : '' }}>Lleida</option>
            </select>
        </div>


        <div class="mb-3">
            <label for="imatge" class="form-label">{{ __("Imatge") }}</label>
            <input name="imatge" type="file" class="form-control">
            @if($municipi->imatge)
            <div class="mt-2">
                <img src="{{ asset($municipi->imatge) }}" alt="Imagen de {{ $municipi->nom }}" class="img-fluid" width="200">
            </div>
            @endif

            @error('imatge')
            <div class="fs-6 text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Guardar cambios</button>
    </form>
</div>
@endsection