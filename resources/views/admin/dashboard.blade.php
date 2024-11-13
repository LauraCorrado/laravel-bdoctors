@extends('layouts.app')

@section('content')
<div class="container">
    @if($doctor)
    <h1 class="fs-4 text-secondary my-4">
        {{ __('Dashboard di ') }} {{$doctor->user_name}} {{$doctor->user_surname}}
    </h1>
    <p><strong>{{ __('Media dei voti:') }}</strong> {{ number_format($averageRating, 1) }} / 5</p>
    @else
    <h1 class="fs-4 text-secondary my-4">
        {{ __('Non è stato trovato alcun dottore associato a questo account.') }}
    </h1>
    @endif
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
                    <div class="row text-center">
                        <div class="mt-md-4 show-buttons col-12 col-md-6 col-lg-3">
                            <a href="{{ route('admin.doctors.edit', $doctor->id) }}"
                                class="mt-1 text-decoration-none save">{{
                                __('Modifica i tuoi dati') }}
                            </a>
                        </div>
                        <div class="mt-md-4 show-buttons col-12 col-md-6 col-lg-3">
                            <a href="{{ route('admin.messages.index') }}" class="mt-1 text-decoration-none save">{{
                                __('I tuoi messaggi') }}</a>
                        </div>
                        <div class="mt-md-4 show-buttons col-12 col-md-6 col-lg-3">
                            <a href="{{ route('admin.reviews.index') }}" class="mt-1 text-decoration-none save">{{
                                __('Recensioni') }}</a>
                        </div>
                        {{-- Braintree-linked button --}}
                        <div class="mt-md-4 show-buttons col-12 col-md-6 col-lg-3">
                            <a href="{{ route('admin.doctors.braintree') }}" class="mt-1 text-decoration-none save">{{ __('Promuovi il profilo') }}</a>
                        </div>
                        {{-- <div class="mt-md-4 show-buttons col-12 col-md-6 col-lg-3">
                            <a href="{{ route('admin.ratings.index') }}" class="mt-1 text-decoration-none save">{{
                                __('Le tue statistiche') }}</a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection