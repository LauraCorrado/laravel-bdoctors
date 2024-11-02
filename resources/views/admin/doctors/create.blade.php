@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="mb-5 text-center">
                <h1>Grazie per la tua iscrizione!</h1>
                <h2 class="m-2">Crea qui il tuo profilo</h2>
                <p>I campi contrassegnati con <strong>*</strong> sono obbligatori</p>
            </div>
            <form action="{{ route('admin.doctors.store') }}" method="POST" class="my-4 text-center">
                @csrf
                <div class="row g-3">
                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="user_name" class="form-label fw-bolder m-0 py-1">Nome*</label>
                        <input type="text" name="user_name" id="user_name" placeholder="Nome" class="form-control" required value="{{ old('user_name') }}">
                        @error('user_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="user_surname" class="form-label fw-bolder m-0 py-1">Cognome*</label>
                        <input type="text" name="user_surname" id="user_surname" placeholder="Cognome" class="form-control" required value="{{ old('user_surname') }}">
                        @error('user_surname')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="address" class="form-label fw-bolder m-0 py-1">Indirizzo*</label>
                        <input type="text" name="address" id="address" placeholder="Indirizzo" class="form-control" required value="{{ old('address') }}">
                        @error('address')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="city" class="form-label fw-bolder m-0 py-1">Città*</label>
                        <input type="text" name="city" id="city" placeholder="Città" class="form-control" required value="{{ old('city') }}">
                        @error('city')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="phone_number" class="form-label fw-bolder m-0 py-1">Numero di telefono*</label>
                        <input type="text" name="phone_number" id="phone_number" placeholder="Numero di telefono" class="form-control" required value="{{ old('phone_number') }}">
                        @error('phone_number')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bolder m-0 py-1" for="fields">Specializzazioni*</label>
                        <p>Seleziona uno o più campi di specializzazione</p>
                        <div class="row py-3">
                            @foreach($fields as $field)
                            <div class="col-6 col-md-4 d-flex">
                                <div class="form-check-inline m-0">
                                    <input type="checkbox" name="fields[]" class="form-check-input" value="{{ $field->id }}" {{ is_array(old('fields')) && in_array($field->id, old('fields')) ? 'checked' : '' }}>
                                    <label class="form-check-label ps-1">{{ $field->name }}</label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @error('fields')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="performance" class="form-label fw-bolder m-0 py-1">Prestazioni*</label>
                        <textarea name="performance" id="performance" rows="4" class="form-control" placeholder="Descrivi le tue prestazioni" required>{{ old('performance') }}</textarea>
                        @error('performance')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <button type="submit" class="mt-3 save">Salva i dati</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
