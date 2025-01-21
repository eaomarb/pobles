@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-3">
        <a href="{{ route('municipis.provincies') }}" class="btn btn-secondary">Darrere</a>
    </div>

    <div class="w-full">
        <div class="flex flex-wrap">
            <h1 class="mb-5">Mostrar Municipi: {{ $municipi->nom }}</h1>
        </div>
    </div>

    <!-- Aquí se muestra la información del municipio -->
    <div class="mb-3">
        <strong>{{ __("Nom:") }}</strong>
        <p>{{ $municipi->nom }}</p>
    </div>

    <div class="mb-3">
        <strong>{{ __("Descripció:") }}</strong>
        <p>{{ $municipi->descripcio }}</p>
    </div>

    <div class="mb-3">
        <strong>{{ __("Comarca:") }}</strong>
        <p>{{ $municipi->comarca }}</p>
    </div>

    <div class="mb-3">
        <strong>{{ __("Província:") }}</strong>
        <p>{{ $municipi->provincia }}</p>
    </div>

    <div class="mb-3">
        <strong>{{ __("Imatge:") }}</strong>
        @if($municipi->imatge)
        <div class="mt-2">
            <img src="{{ asset($municipi->imatge) }}" alt="Imagen de {{ $municipi->nom }}" class="img-fluid" width="500">
        </div>
        @else
        <p>No hi ha imatge disponible</p>
        @endif
    </div>

    <!-- Botón de editar si el usuario está logueado -->
    @auth
    <div class="mt-3">
        <a href="{{ route('municipis.edit', $municipi->id) }}" class="btn btn-primary">Editar</a>
    </div>
    @endauth
</div>
@endsection
