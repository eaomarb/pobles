@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">{{ $municipi->nom }}</h1>
    <div class="mb-3">
        <img class="img-fluid" src="{{ asset($municipi->imatge) }}" alt="Foto de {{ $municipi->nom }}">
    </div>
    <div class="mb-3">
        <strong>{{ __('Descripció') }}:</strong>
        <p>{{ $municipi->descripcio }}</p>
    </div>
    <div class="mb-3">
        <strong>{{ __('Província') }}:</strong>
        <p>{{ $municipi->provincia->nom }}</p>
    </div>
    <a href="{{ route('municipis.index') }}" class="btn btn-secondary">Tornar a la llista</a>
    <a href="{{ route('municipis.edit', $municipi->id) }}" class="btn btn-warning">Editar</a>
</div>
@endsection
