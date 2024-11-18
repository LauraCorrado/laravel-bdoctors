@extends('layouts.app')
@section('title', 'BD - Statistiche')
@section('content')

<div class="container py-5">
    <div class="row mt-2 position-relative">
        @include('partials.prev-btn')
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

        <div class="col-12">
            <div class="d-flex justify-content-center">
                <a href="{{route('admin.reviews.index')}}" class="text-decoration-none mt-3 stats-redirect">Visualizza tutte le recensioni</a>
            </div>
            <div class="d-flex justify-content-center">
                <a href="{{route('admin.messages.index')}}" class="text-decoration-none mt-3 stats-redirect">Visualizza tutti i messaggi</a>
            </div>
        </div>

        @if ($messageCount > 0 || $reviewCount > 0 || $totalVotes > 0)
        <!-- Grafico a torta per Messaggi, Recensioni, e Voti -->
        <div class="col-12 col-lg-4 mt-5">
            <h2 class="text-center stat-title">Messaggi, Recensioni e Voti in questo mese</h2>
            <div class="d-flex justify-content-center">
                <div class="w-50 text-center">
                    <canvas id="statsPieChart"></canvas>
                </div>
            </div>
        </div>
        <!-- Grafico a barre per la distribuzione dei voti -->
        <div class="col-12 col-lg-4 mt-5">
            <h2 class="text-center stat-title">Distribuzione mensile dei voti per fascia di voto</h2>
            <div class="ratio ratio-16x9 d-flex justify-content-center">
                <canvas id="votesBarChart"></canvas>
            </div>
        </div>
        
        {{-- grafico a barre con voti in mese ed anno corrente --}}
        <div class="col-12 col-lg-4 mt-5">
            <h2 class="text-center stat-title">Distribuzione dei voti per fascia di voto - Mese e Anno</h2>
            <div class="ratio ratio-16x9 d-flex justify-content-center">
                <canvas id="monthlyVotesBarChart"></canvas>
            </div>
        </div>
        @endif

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
    const monthlyVoteDistribution = @json($monthlyVoteDistribution);  // Distribuzione dei voti per mese e anno

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

    // Crea il grafico a barre per la distribuzione dei voti (Mese e Anno)
    var ctxBar = document.getElementById('monthlyVotesBarChart').getContext('2d');
    var monthlyVotesBarChart = new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: ['Gen', 'Feb', 'Mar', 'Apr', 'Mag', 'Giu', 'Lug', 'Ago', 'Set', 'Ott', 'Nov', 'Dic'],  // Mesi
            datasets: [
                {
                    label: '1 Stella',
                    data: [
                        monthlyVoteDistribution[1][1], monthlyVoteDistribution[2][1], monthlyVoteDistribution[3][1],
                        monthlyVoteDistribution[4][1], monthlyVoteDistribution[5][1], monthlyVoteDistribution[6][1],
                        monthlyVoteDistribution[7][1], monthlyVoteDistribution[8][1], monthlyVoteDistribution[9][1],
                        monthlyVoteDistribution[10][1], monthlyVoteDistribution[11][1], monthlyVoteDistribution[12][1]
                    ], // Dati per 1 stella
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: '2 Stelle',
                    data: [
                        monthlyVoteDistribution[1][2], monthlyVoteDistribution[2][2], monthlyVoteDistribution[3][2],
                        monthlyVoteDistribution[4][2], monthlyVoteDistribution[5][2], monthlyVoteDistribution[6][2],
                        monthlyVoteDistribution[7][2], monthlyVoteDistribution[8][2], monthlyVoteDistribution[9][2],
                        monthlyVoteDistribution[10][2], monthlyVoteDistribution[11][2], monthlyVoteDistribution[12][2]
                    ], // Dati per 2 stelle
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: '3 Stelle',
                    data: [
                        monthlyVoteDistribution[1][3], monthlyVoteDistribution[2][3], monthlyVoteDistribution[3][3],
                        monthlyVoteDistribution[4][3], monthlyVoteDistribution[5][3], monthlyVoteDistribution[6][3],
                        monthlyVoteDistribution[7][3], monthlyVoteDistribution[8][3], monthlyVoteDistribution[9][3],
                        monthlyVoteDistribution[10][3], monthlyVoteDistribution[11][3], monthlyVoteDistribution[12][3]
                    ], // Dati per 3 stelle
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: '4 Stelle',
                    data: [
                        monthlyVoteDistribution[1][4], monthlyVoteDistribution[2][4], monthlyVoteDistribution[3][4],
                        monthlyVoteDistribution[4][4], monthlyVoteDistribution[5][4], monthlyVoteDistribution[6][4],
                        monthlyVoteDistribution[7][4], monthlyVoteDistribution[8][4], monthlyVoteDistribution[9][4],
                        monthlyVoteDistribution[10][4], monthlyVoteDistribution[11][4], monthlyVoteDistribution[12][4]
                    ], // Dati per 4 stelle
                    backgroundColor: 'rgba(153, 102, 255, 0.5)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                },
                {
                    label: '5 Stelle',
                    data: [
                        monthlyVoteDistribution[1][5], monthlyVoteDistribution[2][5], monthlyVoteDistribution[3][5],
                        monthlyVoteDistribution[4][5], monthlyVoteDistribution[5][5], monthlyVoteDistribution[6][5],
                        monthlyVoteDistribution[7][5], monthlyVoteDistribution[8][5], monthlyVoteDistribution[9][5],
                        monthlyVoteDistribution[10][5], monthlyVoteDistribution[11][5], monthlyVoteDistribution[12][5]
                    ], // Dati per 5 stelle
                    backgroundColor: 'rgba(255, 159, 64, 0.5)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                }
            ]
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
                            return Number.isInteger(value) ? value : ''; // Mostra solo numeri interi
                        }
                    }
                }
            }
        }
    });
</script>

@endsection
