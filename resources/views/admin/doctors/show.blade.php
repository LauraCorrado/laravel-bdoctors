@extends('layouts.app')

@section('title', 'Dettagli - ' . $doctor->user_name . ' ' . $doctor->user_surname)

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 text-center mb-5">
            <h1>Profilo di <strong class="user-name">{{ $doctor->user_name }} {{ $doctor->user_surname }}</strong></h1>
        </div>
    </div>
    @if ($doctor->sponsors && $doctor->sponsors->isNotEmpty())
    <div class="row mb-3">
        <div class="col-12 text-center">
            <h3 class="packages-title">Pacchetto/i di sponsorizzazione:</h3>
        </div>
        <div class="col-12 col-md-6 offset-md-3">
            <ul class="show-sponsor-section list-unstyled profile-bg rounded d-flex flex-column align-items-center justify-content-center">
                @foreach ($doctor->sponsors()->orderBy('pivot_expiring_date')->get() as $sponsor)
                {{-- se scadenza è nel futuro --}}
                @if (Carbon\Carbon::parse($sponsor->pivot->expiring_date)->isFuture())
                    <li class="my-1">
                        <span class="badge badge-success text-capitalize p-2 me-1">{{$sponsor->package}}</span>
                        <span class="badge badge-danger p-2">SCADENZA: {{\Carbon\Carbon::parse($sponsor->pivot->expiring_date)->format('d/m/Y H:i') }}</span>
                    </li>
                @endif
                        {{-- </span> da {{ \Carbon\Carbon::parse($sponsor->pivot->created_at)->format('d/m/Y H:i') }} con scadenza il {{\Carbon\Carbon::parse($sponsor->pivot->expiring_date)->format('d/m/Y H:i') }}</span> --}}
                @endforeach
            </ul>
        </div>
    </div>
    @endif
    <div class="row text-center profile-bg rounded">
        <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
            <div class="avatars rounded">
                @if (!Str::startsWith($doctor->thumb, 'https'))
                <img src="{{ asset('storage/'.$doctor->thumb) }}" alt="doctor-avatar">
                @else
                <img src="{{ $doctor->thumb }}" alt="doctor-avatar">
                @endif
            </div>
        </div>
        <div class="col-12 col-md-6 p-5">
            <div class="row py-3">
                <div class="col-12 col-md-6">
                    <h5>Dr./Dr.ssa <strong>{{ $doctor->user_surname }} {{ $doctor->user_name }}</strong></h5>
                </div>
                <div class="col-12 col-md-6">
                    @if ($doctor->cv)
                    <a href="{{asset('storage/'.$doctor->cv)}}" target="_blank">Curriculum Vitae</a>
                    @else
                    <p>CV assente</p>
                    @endif
                </div>
            </div>
            <div class="row pb-3">
                <div class="col-12 col-md-6">
                    <h5>Indirizzo e città:</h5>
                    <p>{{ $doctor->address }}, {{ $doctor->city }}</p>
                </div>
                <div class="col-12 col-md-6">
                    <h5>Numero di Telefono:</h5>
                    <p>{{ $doctor->phone_number }}</p>
                </div>
            </div>
            <div class="row pb-3 gy-3">
                <div class="col-12">
                    <h5>Prestazioni:</h5>
                    <p class="performances">{{ $doctor->performance }}</p>
                </div>
                <div class="col-12">
                    <h5>Specializzazioni:</h5>
                    @if ($doctor->fields && $doctor->fields->isNotEmpty())
                    @foreach ($doctor->fields as $field)
                    <strong>{{ $field->name }}</strong><br>
                    @endforeach
                    @else
                    <strong>Non sono state specificate le specializzazioni</strong>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center mt-4">
            <div class="my-4 show-buttons">
                <a href="{{ route('admin.doctors.edit', $doctor->id) }}"
                    class="text-decoration-none save">{{__('Modifica')}}</a>
                <a href="{{route('admin.dashboard')}}" class="text-decoration-none back">{{ __('Vai alla
                dashboard') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection


