@extends('layouts.app')

@section('content')

<div class="cover-image-section d-flex align-items-center justify-content-center">
    <div class="bg-blur-panel d-flex align-items-center p-4 rounded">
        <h1 class="text-white display-4 fw-bold d-flex align-items-center m-0">
            Benvenuto in BDoctors
            <img src="{{ Vite::asset('/resources/img/logo.png') }}" alt="Logo BDoctors" class="ms-3 logo-img">
        </h1>
    </div>
</div>

<div class="py-5 welcome-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center homepage-text-box rounded">
                    <h2 class="mb-3 title-box">Crea e gestisci il tuo profilo medico in modo semplice e intuitivo!</h2>
                    <p>Se sei un medico, potrai <a href="{{ route('register') }}" class="link-homepage position-relative text-decoration-none">registrarti <i class="bi bi-box-arrow-up-right small-icon position-absolute"></i></a>, aggiornare le tue informazioni, visualizzare i messaggi e le recensioni ricevute, sponsorizzare il tuo profilo e monitorare le tue statistiche personali.</p>
                    <p>I visitatori potranno cercare medici specialisti, visualizzare i dettagli dei professionisti e inviare richieste di disponibilità, garantendo un’interazione diretta e trasparente tra medico e paziente.</p>
                    <div class="pt-3 d-flex justify-content-center align-items-center buttons-home">
                        <a class="text-decoration-none button-home btn-register" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                        <a class="text-decoration-none button-home btn-login" href="{{ route('login') }}">{{ __('Accedi') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
