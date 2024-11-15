@extends('layouts.app')

@section('content')
<div class="container my-5">
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
    <div class="row">
        <div class="col-12">
            <div class="rounded bg-info p-3">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="bi bi-person-fill text-primary me-2"></i>
                                    Profilo personale
                                </h5>
                                <p class="card-text">Qui puoi modficare il tuo profilo personale.</p>
                                <div class="text-center">
                                    <a href="{{ route('admin.doctors.edit', $doctor->id) }}" class="mt-1 text-decoration-none save">
                                        {{ __('Modifica profilo') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="bi bi-envelope-fill text-primary me-2"></i>
                                    I tuoi messaggi
                                </h5>
                                <p class="card-text">Qui puoi visualizzare i messaggi dei tuoi pazienti.</p>
                                <div class="text-center">
                                    <a href="{{ route('admin.messages.index') }}" class="mt-1 text-decoration-none save">{{__('Visualizza messaggi') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="bi bi-star-fill text-primary me-2"></i>
                                    Recensioni
                                </h5>
                                <p class="card-text">Qui puoi visualizzare le recensioni ricevute.</p>
                                <div class="text-center">
                                    <a href="{{ route('admin.reviews.index') }}" class="mt-1 text-decoration-none save">{{__('Visualizza recensioni') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="bi bi-credit-card-2-front-fill text-primary me-2"></i>
                                    Promozioni
                                </h5>
                                <p class="card-text">Qui puoi acquistare i pacchetti per promuovere il tuo profilo.</p>
                                <div class="text-center">
                                    <a href="{{ route('admin.sponsors.index') }}" class="mt-1 text-decoration-none save">{{ __('Promuovi il profilo') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="bi bi-bar-chart-line-fill text-primary me-2"></i>
                                    Statistiche
                                </h5>
                                <p class="card-text">Qui puoi visualizzare le tue statistiche personali.</p>
                                <div class="text-center">
                                    <a href="{{ route('admin.stats.index') }}" class="mt-1 text-decoration-none save">{{ __('Visualizza statistiche') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="bi bi-gear-fill text-primary me-2"></i>
                                    Impostazioni
                                </h5>
                                <p class="card-text">Qui puoi le impostazioni del tuo account.</p>
                                <div class="text-center">
                                    <a href="{{ url('profile') }}" class="mt-1 text-decoration-none save">{{__('Modifica mpostazioni')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection