@extends('layouts.app')

@section('content')

<div class="container py-5">
    <div class="row mt-2">
        <div class="col-12 text-center mb-5">
            <h1>Le tue Statistiche</h1>
        </div>

        <!-- Sezione per visualizzare le statistiche -->
        <div class="col-12 text-center">
            <h2>Statistiche Generali</h2>
            <p><strong>Numero di Messaggi Ricevuti:</strong> {{ $messageCount }}</p>
            <p><strong>Numero di Recensioni:</strong> {{ $reviewCount }}</p>
            <p><strong>Numero Totale di Voti Ricevuti:</strong> {{ $totalVotes }}</p>
            <p><strong>{{ __('Media dei voti:') }}</strong> {{ number_format($averageRating, 1) }} / 5</p>
        </div>

        <div class="col-12">
            <div class="d-flex justify-content-center">
                <a href="{{ route('admin.dashboard') }}" class="back text-decoration-none">Torna alla dashboard</a>
            </div>
        </div>
    </div>
</div>

@endsection
