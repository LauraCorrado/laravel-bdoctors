@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="content text-center">
                <h1 class="m-2">Crea il tuo profilo</h1>
                <form action="{{ route('admin.doctors.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-4">
                            <label for="user_name">Nome</label>
                            <input type="text" name="user_name" id="user_name" placeholder="Nome">
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label for="user_surname">Cognome</label>
                            <input type="text" name="user_surname" id="user_surname" placeholder="Cognome">
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label for="address">Indirizzo</label>
                            <input type="text" name="address" id="address" placeholder="Indirizzo">
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label for="city">Città</label>
                            <input type="text" name="city" id="city" placeholder="Città">
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label for="phone_number">Numero di telefono</label>
                            <input type="text" name="phone_number" id="phone_number" placeholder="Numero di telefono">
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <label for="performances">Prestazioni</label>
                            <textarea name="performances" id="performances" cols="30" rows="10"></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-sm btn-success">Salva i dati</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection