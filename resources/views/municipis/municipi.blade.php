@extends('layouts.app')

@section("content")

<div class="container mt-5">
    <div class="mb-3">
        <a href="{{ route('') }}" class="btn btn-secondary">Darrere</a>
    </div>

    <div class="text-center">
        <h1>{{ __("Llistat de Municipis") }}</h1>
        <a href="{{ route("municipi.create") }}" class="btn btn-primary">
            {{ __("Afegir Municipi") }}
        </a>
    </div>

    <table class="table table-bordered mb-5 mt-5">
        <thead>
            <tr class="table-success">
                <th>{{ __("Id") }}</th>
                <th>{{ __("Nom") }}</th>
                <th>{{ __("Provincia") }}</th>
                <th>{{ __("Accions") }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($municipis as $municipi)
            <tr>
                <th scope="row">{{ $municipi->id }}</th>
                <td>{{ $municipi->nom }}</td>
                <td>{{ $municipi->provincia }}</td>
                <td>
                    <a href="{{ route("municipi.show", ["municipi" => $municipi]) }}" class="btn btn-info">{{ __("Mostrar Municipi") }}</a>
                    <a href="{{ route("municipi.edit", ["municipi" => $municipi]) }}" class="btn btn-warning">{{ __("Editar") }}</a>
                    <a href="#" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete-municipi-{{ $municipi->id }}-form').submit();">{{ __("Eliminar") }}</a>
                    <form id="delete-municipi-{{ $municipi->id }}-form" action="{{ route("municipi.destroy", ["municipi" => $municipi]) }}" method="POST" class="hidden">
                        @method("DELETE")
                        @csrf
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4">
                    <div class="text-center" role="alert">
                        <p><strong class="font-bold">{{ __("No hi ha municipis") }}</strong></p>
                        <span>{{ __("No hi ha cap dada a mostrar") }}</span>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {!! $municipis->links() !!}
    </div>
</div>

@endsection
