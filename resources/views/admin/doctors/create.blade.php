@extends('layouts.app')
@section('title', 'BD - Crea profilo')
@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <div class="mb-5 text-center">
                <h1>Grazie per l'iscrizione, <strong>{{$user->name}} {{$user->surname}}</strong>!</h1>
                <h3 class="m-2">Aggiungi informazioni al tuo profilo</h3>
                <p>I campi contrassegnati con <strong>*</strong> sono obbligatori</p>
            </div>
            <form id="form-doc-create" action="{{ route('admin.doctors.store') }}" method="POST" class="my-4 create-edit-welcome"
                enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="user_name" class="form-label fw-bolder m-0 py-1">Nome</label>
                        <input type="text" name="user_name" id="user_name" placeholder="Nome" class="form-control @error('user_name') is-invalid @enderror"
                         value="{{ old('user_name', auth()->user()->name) }}" readonly>
                        @error('user_name')
                        <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="user_surname" class="form-label fw-bolder m-0 py-1">Cognome</label>
                        <input type="text" name="user_surname" id="user_surname" placeholder="Cognome"
                            class="form-control @error('user_surname') is-invalid @enderror" value="{{ old('user_name', auth()->user()->surname) }}" readonly>
                        @error('user_surname')
                        <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="address" class="form-label fw-bolder m-0 py-1">Indirizzo*</label>
                        <input type="text" name="address" id="address" placeholder="Indirizzo" class="form-control @error('address') is-invalid @enderror"
                         value="{{ old('address') }}">
                        @error('address')
                        <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="city" class="form-label fw-bolder m-0 py-1">Città*</label>
                        <input type="text" name="city" id="city" placeholder="Città" class="form-control @error('city') is-invalid @enderror"
                            value="{{ old('city') }}">
                        @error('city')
                        <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="phone_number" class="form-label fw-bolder m-0 py-1">Numero di telefono*</label>
                        <input type="text" name="phone_number" id="phone_number" placeholder="Numero di telefono"
                            class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}">
                        @error('phone_number')
                        <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="cv" class="form-label fw-bolder m-0 py-1">Curriculum Vitae</label>
                        <input type="file" name="cv" id="cv" placeholder="Importa il tuo cv"
                            class="form-control">
                        @error('cv')
                        <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="thumb" class="form-label fw-bolder m-0 py-1">Immagine del profilo</label>
                        <input type="file" name="thumb" id="thumb" placeholder="Immagine del profilo"
                            class="form-control">
                        @error('thumb')
                        <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="text-center my-3">
                            <label class="form-label fw-bolder" for="fields">Specializzazioni*</label>
                            <p>Seleziona uno o più campi di specializzazione</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="row py-3">
                            @foreach($fields as $field)
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-check mb-2">
                                        <input type="checkbox" name="fields[]" class="form-check-input"
                                            value="{{ $field->id }}" {{ is_array(old('fields')) && in_array($field->id, old('fields')) ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ $field->name }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @error('fields')
                        <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <label for="performance" class="form-label fw-bolder m-0 py-1">Prestazioni*</label>
                        <textarea name="performance" id="performance" rows="4" class="form-control @error('performance') is-invalid @enderror"
                            placeholder="Descrivi le tue prestazioni">{{ old('performance') }}</textarea>
                        @error('performance')
                        <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                        <div class="text-center">
                            <button type="submit" class="mt-3 save">Salva i dati</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection