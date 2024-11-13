@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <p>Sponsor package: {{ $sponsor->package }}</p>
            <a href="{{ route('admin.doctors.braintree', ['sponsorId' => $sponsor->id]) }}">Paga</a>
        </div>
    </div>
</div>
@endsection