@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">{{ __('Municipis de la província: ') }} {{ $provincia ?? 'Desconeguda' }}</h1>

    <div class="mb-3">
        <form method="GET" action="{{ route('municipis.provincia', $provincia) }}">
            <input type="hidden" name="provincia" value="{{ $provincia }}">
            <label for="perPage" class="form-label">Mostrar por página:</label>
            <select name="itemsPerPage" id="perPage" class="form-select" onchange="this.form.submit()">
                <option value="5" {{ request('itemsPerPage') == 5 ? 'selected' : '' }}>5</option>
                <option value="10" {{ request('itemsPerPage') == 10 ? 'selected' : '' }}>10</option>
                <option value="20" {{ request('itemsPerPage') == 20 ? 'selected' : '' }}>20</option>
                <option value="50" {{ request('itemsPerPage') == 50 ? 'selected' : '' }}>50</option>
                <option value="100" {{ request('itemsPerPage') == 100 ? 'selected' : '' }}>100</option>
                <option value="all" {{ request('itemsPerPage') == 'all' ? 'selected' : '' }}>Todos</option>
            </select>
        </form>
    </div>

    <div class="row">
        @foreach ($municipis as $municipi)
        <div class="col-md-4 mb-3">
            <div class="card">
                <img class="img-fluid" src="{{ asset($municipi->imatge) }}" alt="Foto de {{ $municipi->nom }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $municipi->nom }}</h5>
                    <p class="card-text">{{ $municipi->descripcio }}</p>

                    <a href="{{ route('municipis.show', $municipi->id) }}" class="btn btn-info">Ver</a>

                    @auth
                    <a href="{{ route('municipis.edit', $municipi->id) }}" class="btn btn-primary">Editar</a>
                    @endauth
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center">
        @if ($municipis instanceof \Illuminate\Pagination\AbstractPaginator)
            {{ $municipis->links() }}
        @endif
    </div>
</div>
@endsection