@extends('layouts.app')

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

        {{-- Messaggi m/a --}}
        <div class="col-12 mt-5 p-3 rounded stats-details">
            <h3 class="text-center months_years">Numero di messaggi ricevuti per mese e anno</h3>
            <div class="d-flex justify-content-center">
                @foreach ($monthlyMessages as $monthYear => $count)
                    <p class="badge badge-stats-section badge-messages p-3 fs-5">{{$count}} nel {{$monthYear}}</p>
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                <a href="{{route('admin.messages.index')}}" class="text-decoration-none mt-3 stats-redirect">Visualizza tutti i messaggi</a>
            </div>
        </div>

        {{-- Recensioni m/a --}}
        <div class="col-12 mt-5 p-3 rounded stats-details">
            <h3 class="text-center months_years">Numero di recensioni ricevute per mese e anno</h3>
            <div class="d-flex justify-content-center flex-wrap">
                @foreach ($monthlyReviews as $monthYearRev => $count)
                    <p class="badge badge-stats-section badge-reviews p-3 fs-5 mx-2">{{$count}} nel {{$monthYearRev}}</p>
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                <a href="{{route('admin.reviews.index')}}" class="text-decoration-none mt-3 stats-redirect">Visualizza tutte le recensioni</a>
            </div>
        </div>

        <!-- Grafico dei Voti per Mese e Anno -->
        <div class="col-12 mt-5">
            <h2 class="text-center stat-title">Distribuzione dei Voti per Mese e Anno</h2>
            <canvas id="votesChart"></canvas>
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
    const labels = @json($labels);  // Mesi e anni (YYYY-MM)
    const data = @json($data);  // Dati per ciascun voto (1, 2, 3, 4, 5)

    // Crea il grafico a barre
    var ctx = document.getElementById('votesChart').getContext('2d');
    var votesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels, // Mesi e Anni come etichette (YYYY-MM)
            datasets: [
                {
                    label: 'Voti 1',
                    data: data['1'], // Contatore per il voto 1
                    backgroundColor: 'rgba(255, 99, 132, 0.2)', // Colore delle barre
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Voti 2',
                    data: data['2'], // Contatore per il voto 2
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Voti 3',
                    data: data['3'], // Contatore per il voto 3
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Voti 4',
                    data: data['4'], // Contatore per il voto 4
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Voti 5',
                    data: data['5'], // Contatore per il voto 5
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Numero di Voti'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Mese e Anno'
                    }
                }
            }
        }
    });
</script>

@endsection

