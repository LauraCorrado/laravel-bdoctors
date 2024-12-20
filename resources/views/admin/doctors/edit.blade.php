@extends('layouts.app')
@section('title', 'BD - Modifica profilo')
@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12 position-relative">
            @include('partials.prev-btn')
            <div class="mb-5 mt-1 text-center">
                <h1>Modifica il tuo profilo</h1>
                <p>I campi contrassegnati con <strong>*</strong> sono obbligatori</p>
            </div>
            <form id="form-doc-edit" action="{{ route('admin.doctors.update', ['doctor' => $doctor->id]) }}" method="post"
                class="my-4 create-edit-welcome" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="user_name" class="form-label fw-bolder m-0 py-1">Nome*</label>
                        <input type="text" name="user_name" id="user_name" placeholder="Nome" class="form-control"
                         value="{{ old('user_name', $doctor->user_name) }}">
                        @error('user_name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="user_surname" class="form-label fw-bolder m-0 py-1">Cognome*</label>
                        <input type="text" name="user_surname" id="user_surname" placeholder="Cognome"
                            class="form-control" value="{{ old('user_surname', $doctor->user_surname) }}">
                        @error('user_surname')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="address" class="form-label fw-bolder m-0 py-1">Indirizzo*</label>
                        <input type="text" name="address" id="address" placeholder="Indirizzo" class="form-control"
                         value="{{ old('address', $doctor->address) }}">
                        @error('address')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="city" class="form-label fw-bolder m-0 py-1">Città*</label>
                        <input type="text" name="city" id="city" placeholder="Città" class="form-control"
                            value="{{ old('city', $doctor->city) }}">
                        @error('city')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="phone_number" class="form-label fw-bolder m-0 py-1">Numero di telefono*</label>
                        <input type="text" name="phone_number" id="phone_number" placeholder="Numero di telefono"
                            class="form-control" value="{{ old('phone_number', $doctor->phone_number) }}">
                        @error('phone_number')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="cv" class="form-label fw-bolder m-0 py-1">Curriculum Vitae</label>

                        <input type="file" name="cv" id="cv" placeholder="Importa il tuo cv" 
                            class="form-control" value="{{ old('cv') }}">
                        @error('cv')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        
                        @if ($doctor->cv)
                            <p class="mt-1 cv-exists">File corrente: <a href="{{ asset('storage/' . $doctor->cv) }}" target="_blank">Visualizza CV</a></p>
                        @endif
                    
                    </div>
                    
                    @if ($doctor->thumb && !str_starts_with($doctor->thumb, 'http'))
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="text-center">
                            <label for="thumb" class="form-label fw-bolder m-0 py-1">Immagine del profilo</label>
                                <p>Immagine corrente:</p>
                                <div class="profile-pic mx-auto">
                                    <img src="{{ asset('storage/' . $doctor->thumb) }}" alt="Immagine del profilo" class="img-fluid img-thumbnail mb-2">
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="thumb" class="form-label fw-bolder m-0 py-1">Immagine del profilo</label>
                        <input type="file" name="thumb" id="thumb" placeholder="Immagine del profilo" 
                            class="form-control" value="{{ old('thumb') }}">
                        @error('thumb')
                        <div class="text-danger">{{ $message }}</div>
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
                        <div class="row">
                            @foreach($fields as $field)
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-check mb-2">
                                        <input type="checkbox" name="fields[]" class="form-check-input"
                                            value="{{ $field->id }}" {{ in_array($field->id, old('fields', $doctor->fields->pluck('id')->toArray())) ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ $field->name }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @error('fields')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="performance" class="form-label fw-bolder m-0 py-1">Prestazioni*</label>
                        <textarea name="performance" id="performance" rows="4" class="form-control mb-3"
                            placeholder="Descrivi le tue prestazioni"
                        >{{ old('performance', $doctor->performance) }}</textarea>
                        @error('performance')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="text-center">
                            <div class="m-auto">
                                <a class="text-decoration-none back"
                                href="{{ route('admin.doctors.show', ['doctor' => Auth::user()->doctor->slug]) }}">{{
                                __('Torna al profilo') }}
                                </a>
                            </div>
                            <div class="my-3">
                                <button type="submit" class="save">{{ __('Salva le modifiche')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection