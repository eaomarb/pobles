@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('Benvingut!') }}
                    <div class="container text-center mt-5">
                        <div class="col">
                            @foreach ($provincies as $provincia)
                            <a href="{{ route('municipis.provincia', ['provincia' => $provincia]) }}" class="btn btn-outline-primary btn-lg">
                                {{ $provincia }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection