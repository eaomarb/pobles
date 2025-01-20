@extends('layouts.app')

@section("content")

<div class="container mt-5">
    <div class="mb-3">
        <a href="{{ route('provincies') }}" class="btn btn-secondary">Darrere</a>
    </div>

    <div class="text-center">
        <h1>{{ __("Municipis de la província:") }} {{ $provincia }}</h1>
    </div>

    <div class="list-group mb-5">
        @forelse($municipis as $municipi)
        <a href="{{ route('municipi.show', ['municipi' => $municipi->nom]) }}" class="list-group-item list-group-item-action">
            {{ $municipi->nom }}
        </a>
        @empty
        <div class="alert alert-warning">
            <strong>{{ __("No hi ha municipis disponibles per a aquesta província") }}</strong>
        </div>
        @endforelse
    </div>

</div>

@endsection
