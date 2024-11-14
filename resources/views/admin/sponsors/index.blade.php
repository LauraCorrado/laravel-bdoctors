@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <div class="text-center packages-titles">
                <h1 class="fw-bolder">Scegli il pacchetto di sponsor</h1>
                <p class="lead">Metti in risalto il tuo profilo nelle ricerche!</p>
                <p>Seleziona l'opzione che meglio valorizza il profilo per raggiungere più pazienti e far crescere la tua visibilità.</p>
            </div>
        </div>
        @foreach ($sponsors as $sponsor)
        <div class="col-12 col-md-4 mb-4">
            <div class="card packages h-100 my-4 {{ $sponsor->package === 'deluxe' ? 'deluxe-package' : '' }}">
                <div class="card-header text-center text-white">
                    <h5 class="mb-0 text-capitalize">{{ $sponsor->package }}</h5>
                </div>
                <div class="card-body d-flex flex-column align-items-center justify-content-center p-4">
                    <p class="text-muted text-center fs-5">Sponsorizza il tuo profilo per una durata di <strong>{{ $sponsor->duration }}</strong> ore</p>
                    <p class="fs-1 fw-bold m-0 price">{{ $sponsor->price }}€</p>
                </div>
                <div class="card-footer text-center py-4">
                    <a href="{{ route('admin.doctors.braintree', ['sponsorId' => $sponsor->id]) }}" class="save text-decoration-none {{ $sponsor->package === 'deluxe' ? 'deluxe-button' : '' }}">Seleziona</a>
                </div>
            </div>
        </div>
        @endforeach
        <div class="col-12">
            <div class="d-flex justify-content-center mt-5">
                <a href="{{route('admin.dashboard')}}" class="back text-decoration-none">Torna alla dashboard</a>
            </div>
        </div>
    </div>
</div>
@endsection