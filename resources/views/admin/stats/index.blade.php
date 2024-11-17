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
            <h2 class="text-center stat-title">Messaggi, Recensioni e Voti in questo mese</h2>
            <div class="d-flex justify-content-center">
                <div class="w-50 text-center">
                    <canvas id="statsPieChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Grafico a barre per la distribuzione dei voti -->
        <div class="col-12 mt-5">
            <h2 class="text-center stat-title">Distribuzione dei voti per fascia di voto</h2>
            <div class="d-flex justify-content-center">
                <canvas id="votesBarChart"></canvas>
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
    const voteDistribution = @json($voteDistribution);  // Recupera la distribuzione dei voti come oggetto JS

    // Crea il grafico a ciambella (Doughnut Chart)
    var ctxPie = document.getElementById('statsPieChart').getContext('2d');
    var statsPieChart = new Chart(ctxPie, {
        type: 'doughnut',
        data: {
            labels: ['Messaggi', 'Recensioni', 'Voti'],
            datasets: [{
                label: 'Statistiche del mese',
                data: [messageCount, reviewCount, totalVotes], // Dati da visualizzare
                backgroundColor: [
                    'rgba(255, 99, 132)', // Messaggi
                    'rgba(54, 162, 235)', // Recensioni
                    'rgba(75, 192, 192)'  // Voti
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
                },
                doughnutLabel: {
                    display: true,
                    text: 'Statistiche Mese'
                }
            }
        }
    });

    // Crea il grafico a barre per la distribuzione dei voti
    var ctxBar = document.getElementById('votesBarChart').getContext('2d');
    var votesBarChart = new Chart(ctxBar, {
        type: 'bar',  // Tipo di grafico a barre
        data: {
            labels: ['1 stella', '2 stelle', '3 stelle', '4 stelle', '5 stelle'],  // Etichette delle fasce di voto
            datasets: [{
                label: 'Distribuzione dei Voti',
                data: [
                    voteDistribution[1], 
                    voteDistribution[2], 
                    voteDistribution[3], 
                    voteDistribution[4], 
                    voteDistribution[5]
                ], // Dati delle fasce di voto
                backgroundColor: 'rgba(54, 162, 235, 0.5)', // Colore delle barre
                borderColor: 'rgba(54, 162, 235, 1)', // Colore dei bordi
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
                            return 'Voti: ' + tooltipItem.raw;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1, // Imposta a 1 la distanza tra i numeri sull'asse y
                        callback: function(value){
                            return Number.isInteger(value) ? value : ''; // mostra solo inumeri interi
                        }
                    }
                }
            }
        }
    });
</script>

@endsection
