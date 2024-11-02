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

<div class="welcome-text-section text-center py-5">
    <div class="container">
        <p class="lead bg-blur-panel">
            Qui potrai creare e gestire il tuo profilo medico in modo semplice e intuitivo. Se sei un medico, potrai registrarti, aggiornare le tue informazioni, visualizzare messaggi e recensioni ricevute, sponsorizzare il tuo profilo e monitorare le tue statistiche personali. I visitatori potranno cercare medici specialisti, visualizzare i dettagli dei professionisti e inviare richieste di disponibilità, garantendo un’interazione diretta e trasparente tra medico e paziente.
        </p>
    </div>
</div>
@endsection
