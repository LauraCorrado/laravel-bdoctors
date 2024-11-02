@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12 text-center mb-4">
            <h1>Profilo del Medico</h1>
        </div>
        
        <div class="col-md-6 mb-3 border p-3">
            <h5>Nome:</h5>
            <p>{{ $doctor->user_name }}</p>
        </div>
        <div class="col-md-6 mb-3 border p-3">
            <h5>Cognome:</h5>
            <p>{{ $doctor->user_surname }}</p>
        </div>

        <div class="col-md-6 mb-3 border p-3">
            <h5>Indirizzo:</h5>
            <p>{{ $doctor->address }}</p>
        </div>
        <div class="col-md-6 mb-3 border p-3">
            <h5>Città:</h5>
            <p>{{ $doctor->city }}</p>
        </div>

        <div class="col-md-6 mb-3 border p-3">
            <h5>Specializzazioni: 
                @if ($doctor->fields && $doctor->fields->isNotEmpty())
                    @foreach ($doctor->fields as $field)
                        <strong>{{$field->name}}</strong>
                    @endforeach
                @else
                    <strong>Non sono state specificate le specializzazioni</strong>
                @endif
            </h5>
           </div>

        <div class="col-md-6 mb-3 border p-3">
            <h5>Numero di Telefono:</h5>
            <p>{{ $doctor->phone_number }}</p>
        </div>
        <div class="col-md-6 mb-3 border p-3">
            <h5>Prestazioni:</h5>
            <p>{{ $doctor->performance }}</p>
        </div>
    </div>
</div>
@endsection
