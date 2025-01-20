@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('Resultats de la cerca') }}</h1>
    <p>{{ __('Resultats per la cerca: ') }} <strong>{{ $query }}</strong></p>

    @if ($municipis->isEmpty())
        <p>{{ __('No s\'han trobat municipis.') }}</p>
    @else
        <ul class="list-group mb-4">
            @foreach ($municipis as $municipi)
            <li class="list-group-item">
                <a href="{{ route('municipis.show', $municipi->id) }}">{{ $municipi->nom }}</a>
                <span class="text-muted">({{ $municipi->provincia }})</span>
            </li>
            @endforeach
        </ul>

        <!-- Paginación -->
        {{ $municipis->links() }}
    @endif

    <a href="{{ route('provincies.index') }}" class="btn btn-secondary">{{ __('Tornar') }}</a>
</div>
@endsection
