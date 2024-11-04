@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12 text-center mb-4">
            <h1>Profilo di <strong>{{ $doctor->user_name }} {{ $doctor->user_surname }}</strong></h1>
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
            <h5>Immagine:</h5>
            @if (!Str::startsWith($doctor->thumb, 'https'))
            <img src="{{ asset('storage/'.$doctor->thumb) }}" alt="doctor-avatar" class="img-fluid rounded-circle">
            @else
            <img src="{{ $doctor->thumb }}" alt="doctor-avatar" class="img-fluid rounded-circle">
            @endif
        </div>
        <div class="col-md-6 mb-3 border p-3">
            @if ($doctor->cv)
            <a href="{{asset('storage/'.$doctor->cv)}}" target="_blank">Curriculum Vitae</a>
            @endif
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
            <h5>Specializzazioni:</h5>
            @if ($doctor->fields && $doctor->fields->isNotEmpty())
            @foreach ($doctor->fields as $field)
            <strong>{{ $field->name }}</strong><br>
            @endforeach
            @else
            <strong>Non sono state specificate le specializzazioni</strong>
            @endif
        </div>

        <div class="col-md-6 mb-3 border p-3">
            <h5>Numero di Telefono:</h5>
            <p>{{ $doctor->phone_number }}</p>
        </div>
        <div class="col-md-6 mb-3 border p-3">
            <h5>Prestazioni:</h5>
            <p>{{ $doctor->performance }}</p>
        </div>

        <div class="col-12 text-center mt-4">
            <div class="my-3">
                <a href="{{route('admin.dashboard')}}" class="text-decoration-none me-2 back">{{ __('Torna alla
                    dashboard') }}</a>
                <a href="{{ route('admin.doctors.edit', $doctor->id) }}"
                    class="text-decoration-none save">{{__('Modifica')}}</a>
            </div>
        </div>
    </div>
</div>
@endsection