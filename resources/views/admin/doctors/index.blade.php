@extends('layouts.app')

@section('content')

<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-4">Elenco dei Medici</h1>
            
            @foreach ($doctors as $doctor)
            <div class="p-3 mb-4 border rounded">
                <h3 class="fw-bold">{{ $doctor->user_name }} {{ $doctor->user_surname }}</h3>
                <p class="mb-1"><strong>Città:</strong> {{ $doctor->city }}</p>
                <p class="mb-1"><strong>Indirizzo:</strong> {{ $doctor->address }}</p>
                <p class="mb-1"><strong>Telefono:</strong> {{ $doctor->phone_number }}</p>
                <p><strong>Prestazioni:</strong> {{ $doctor->performance }}</p>
            </div>
            @endforeach

        </div>
    </div>
</div>

@endsection
