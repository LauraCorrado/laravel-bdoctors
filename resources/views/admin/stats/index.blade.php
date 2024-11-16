@extends('layouts.app')
@section('title', 'BD - Statistiche')
@section('content')

<div class="container py-5">
    <div class="row mt-2">
        <div class="col-12 text-center mb-3">
            <h1 class="stat-title text-uppercase">Le tue Statistiche</h1>
        </div>

        <!-- Sezione per visualizzare le statistiche -->
        <div class="col-12 d-flex justify-content-center">
            <div class="stats-box text-center">
                <p class="stat-item"><strong>Totale Messaggi Ricevuti:</strong> {{ $messageCount }}</p>
                <p class="stat-item"><strong>Totale Recensioni:</strong> {{ $reviewCount }}</p>
                <p class="stat-item"><strong>Totale Voti Ricevuti:</strong> {{ $totalVotes }}</p>
                <p class="stat-item"><strong>{{ __('Media dei voti:') }}</strong> {{ number_format($averageRating, 1) }} / 5</p>
            </div>
        </div>

        <!-- Grafico a torta per Messaggi, Recensioni, e Voti -->
        <div class="col-12 mt-5">
            <h2 class="text-center stat-title">Distribuzione di Messaggi, Recensioni e Voti nel Mese Corrente</h2>
            <div class="d-flex justify-center">
                <canvas id="statsPieChart"></canvas>
            </div>
        </div>

        <div class="col-12">
            <div class="d-flex justify-content-center mt-4">
                <a href="{{ route('admin.dashboard') }}" class="back text-decoration-none">Torna alla dashboard</a>
            </div>
        </div>
    </div>
</div>

<script>
    // Recupera i dati passati dalla vista
    const messageCount = {{ $messageCount }};
    const reviewCount = {{ $reviewCount }};
    const totalVotes = {{ $totalVotes }};

    // Crea il grafico a torta
    var ctx = document.getElementById('statsPieChart').getContext('2d');
    var statsPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Messaggi', 'Recensioni', 'Voti'],
            datasets: [{
                label: 'Statistiche del mese',
                data: [messageCount, reviewCount, totalVotes], // Dati da visualizzare
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)', // Messaggi
                    'rgba(54, 162, 235, 0.2)', // Recensioni
                    'rgba(75, 192, 192, 0.2)'  // Voti
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw;
                        }
                    }
                }
            }
        }
    });
</script>

@endsection
