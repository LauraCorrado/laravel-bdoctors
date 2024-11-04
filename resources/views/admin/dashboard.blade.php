@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="fs-4 text-secondary my-4">
        {{ __('Dashboard di ') }} {{$doctor->user_name}} {{$doctor->user_surname}}
    </h1>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header"><h5 class="m-0">Benvenuto/a, {{$doctor->user_name}}</h5></div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <p>{{ __('Hai effettuato con successo il login!') }}</p>
                    <p class="m-0">{{ __('Questa è la tua dashboard.') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
