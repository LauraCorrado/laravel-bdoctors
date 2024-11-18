@extends('layouts.app')
@section('title', 'BD - Dashboard')
@section('content')
<div class="container my-5">
    @if($doctor)
    <div class="row position-relative">
        @include('partials.prev-btn')
        <div class="col-12">
            <h1 class="text-center mb-4 dashboard-personal-style">
                {{ __('Dashboard di ') }} {{$doctor->user_name}} {{$doctor->user_surname}}
            </h1>
        </div>
        <div class="col-12">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <p><strong>{{ __('Media dei voti') }}</strong>:
                    <span class="avg-dashboard-color">{{ number_format($averageRating, 1) }} / 5</span>
                </p>
                @if($sponsorExpiration)
                <p><strong>{{ __('Scadenza') }}</strong>:
                    <span id="sponsor-countdown" class="countdown-color"></span>
                </p>
                @endif
            </div>
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-12 position-relative">
            @include('partials.prev-btn')
            <h1 class="fs-4 text-secondary my-4">
                {{ __('Non è stato trovato alcun dottore associato a questo account.') }}
            </h1>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="rounded bg-dashboard p-3">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card mt-3 dashboard-sections">
                            <div class="card-body">
                                <h5 class="card-title fw-bolder titles-dashboard">
                                    <i class="bi bi-person-fill me-2 dashboard-icons"></i>
                                    Profilo personale
                                </h5>
                                <p class="card-text">Qui puoi modficare il tuo profilo personale.</p>
                                <div class="text-center mb-2 mt-4">
                                    <a href="{{ route('admin.doctors.edit', $doctor->id) }}"
                                        class="text-decoration-none save">
                                        {{ __('Modifica profilo') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card mt-3 dashboard-sections">
                            <div class="card-body">
                                <h5 class="card-title fw-bolder titles-dashboard">
                                    <i class="bi bi-envelope-fill me-2 dashboard-icons"></i>
                                    I tuoi messaggi
                                </h5>
                                <p class="card-text">Qui puoi visualizzare i messaggi dei tuoi pazienti.</p>
                                <div class="text-center mb-2 mt-4">
                                    <a href="{{ route('admin.messages.index') }}"
                                        class="text-decoration-none save">{{__('Visualizza messaggi') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card mt-3 dashboard-sections">
                            <div class="card-body">
                                <h5 class="card-title fw-bolder titles-dashboard">
                                    <i class="bi bi-star-fill me-2 dashboard-icons"></i>
                                    Recensioni
                                </h5>
                                <p class="card-text">Qui puoi visualizzare le recensioni ricevute.</p>
                                <div class="text-center mb-2 mt-4">
                                    <a href="{{ route('admin.reviews.index') }}"
                                        class="text-decoration-none save">{{__('Visualizza recensioni') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card mt-3 dashboard-sections">
                            <div class="card-body">
                                <h5 class="card-title fw-bolder titles-dashboard">
                                    <i class="bi bi-credit-card-2-front-fill me-2 dashboard-icons"></i>
                                    Promozioni
                                </h5>
                                <p class="card-text">Qui puoi acquistare i pacchetti per promuovere il tuo profilo.</p>
                                <div class="text-center mb-2 mt-4">
                                    <a href="{{ route('admin.sponsors.index') }}" class="text-decoration-none save">{{
                                        __('Promuovi il profilo') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card mt-3 dashboard-sections">
                            <div class="card-body">
                                <h5 class="card-title fw-bolder titles-dashboard">
                                    <i class="bi bi-bar-chart-line-fill me-2 dashboard-icons"></i>
                                    Statistiche
                                </h5>
                                <p class="card-text">Qui puoi visualizzare le tue statistiche personali.</p>
                                <div class="text-center mb-2 mt-4">
                                    <a href="{{ route('admin.stats.index') }}" class="text-decoration-none save">{{
                                        __('Visualizza statistiche') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card mt-3 dashboard-sections">
                            <div class="card-body">
                                <h5 class="card-title fw-bolder titles-dashboard">
                                    <i class="bi bi-gear-fill me-2 dashboard-icons"></i>
                                    Impostazioni
                                </h5>
                                <p class="card-text">Qui puoi modificare le impostazioni del tuo account.</p>
                                <div class="text-center mb-2 mt-4">
                                    <a href="{{ url('profile') }}" class="mt-1 text-decoration-none save">{{__('Modifica
                                        impostazioni')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if($sponsorExpiration)
<script>
    // data di scadenza della sponsorizzazione
    let sponsorExpirationDate = new Date("{{ $sponsorExpiration->toDateString() }}T{{ $sponsorExpiration->toTimeString() }}").getTime();

    // aggiornamento countdown
    let countdownFunction = setInterval(function() {
        let now = new Date().getTime();
        let distance = sponsorExpirationDate - now;

        // giorni, ore, minuti e secondi
        let days = Math.floor(distance / (1000 * 60 * 60 * 24));
        let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((distance % (1000 * 60)) / 1000);
        // stringa da stampare
        let countdownString = '';
        // casistica
        if (days > 0) {
            countdownString += days + "gg ";
        }
        if (hours > 0) {
            countdownString += hours + "ore ";
        }
        if (minutes > 0 || hours > 0) { // Mostra i minuti se ci sono ore o minuti
            countdownString += minutes + "min ";
        }
        countdownString += seconds + "sec";

        document.getElementById("sponsor-countdown").innerHTML = countdownString;

        // messaggio fine countdown
        if (distance < 0) {
            clearInterval(countdownFunction);
            document.getElementById("sponsor-countdown").innerHTML = "Sponsorizzazione scaduta";
        }
    }, 1000);
</script>
@endif
@endsection