@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 text-center mb-5">
            <h1>{{ $doctor->user_name }}, ecco le tue recensioni</h1>
            <p>Recensione 1</p>
        </div>
    </div>
</div>
@endsection