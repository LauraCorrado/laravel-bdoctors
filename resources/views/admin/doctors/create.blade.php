@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="mb-5 text-center">
                <h1>Grazie per la tua iscrizione!</h1>
                <h2 class="m-2">Crea qui il tuo profilo</h2>
            </div>
                <form action="{{ route('admin.doctors.store') }}" method="POST" class="my-4 text-center">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12 col-md-6 col-lg-4">
                            <label for="user_name" class="form-label fw-bolder m-0 py-1">Nome*</label>
                            <input type="text" name="user_name" id="user_name" placeholder="Nome" class="form-control" required>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label for="user_surname" class="form-label fw-bolder m-0 py-1">Cognome*</label>
                            <input type="text" name="user_surname" id="user_surname" placeholder="Cognome" class="form-control" required>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label for="address" class="form-label fw-bolder m-0 py-1">Indirizzo*</label>
                            <input type="text" name="address" id="address" placeholder="Indirizzo" class="form-control" required>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label for="city" class="form-label fw-bolder m-0 py-1">Città*</label>
                            <input type="text" name="city" id="city" placeholder="Città" class="form-control" required>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label for="phone_number" class="form-label fw-bolder m-0 py-1">Numero di telefono*</label>
                            <input type="text" name="phone_number" id="phone_number" placeholder="Numero di telefono" class="form-control" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bolder m-0 py-1" for="fields">Specializzazioni*</label>
                            <div>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#fieldsModal">Seleziona specializzazioni</button>
                                <div id="selectedFields" class="mt-2"></div>
                            </div>
                            {{-- <div>
                                @foreach($fields as $field)
                                <div class="form-check-inline">
                                    <input type="checkbox" name="fields[]" class="form-check-input" value="{{$field->id}}" {{ is_array(old('fields')) && in_array($field->id, old('fields')) ? 'checked' : ''}}>
                                    <label class="form-check-label">{{$field->name}}</label>
                                </div>
                                @endforeach
                            </div> --}}
                        </div>

                        <div class="col-12">
                            <label for="performance" class="form-label fw-bolder m-0 py-1">Prestazioni*</label>
                            <textarea name="performance" id="performance" rows="4" class="form-control" placeholder="Descrivi le tue prestazioni" required></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="mt-3">Salva i dati</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modale per le Specializzazioni -->
@include('admin.doctors.partials.fields-modal')
@endsection
