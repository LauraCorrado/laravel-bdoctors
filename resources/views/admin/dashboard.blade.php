@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="fs-4 text-secondary my-4">
        {{ __('Dashboard di ') }} {{$doctor->user_name}} {{$doctor->user_surname}}
    </h1>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h5 class="m-0">Benvenuto/a, {{$doctor->user_name}}</h5>
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <p>{{ __('Hai effettuato con successo il login!') }}</p>
                    <p class="mt-1">{{ __('Questa è la tua dashboard.') }}</p>
                    <div class="mt-4 show-buttons">
                        <a href="{{ route('admin.doctors.edit', $doctor->id) }}" class="text-decoration-none save">{{
                            __('Modifica i tuoi dati') }}</a>
                    </div>
                    <div class="mt-4 show-buttons">
                        <a class="mt-1 text-decoration-none save">{{ __('I tuoi messaggi') }}</a>
                    </div>
                    <div class="mt-4 show-buttons">
                        <a class="mt-1 text-decoration-none save">{{ __('Cosa dicono di te i pazienti') }}</a>
                    </div>
                    <div class="mt-4 show-buttons">
                        <a class="mt-1 text-decoration-none save">{{ __('Promuovi il tuo profilo') }}</a>
                    </div>
                    <div class="mt-4 show-buttons">
                        <a class="mt-1 text-decoration-none save">{{ __('Le tue statistiche') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection