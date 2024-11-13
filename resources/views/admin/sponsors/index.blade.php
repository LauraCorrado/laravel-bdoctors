@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            @foreach ($sponsors as $sponsor)
            <p>Sponsor package: {{ $sponsor->package }}</p>
            <a href="{{ route('admin.doctors.braintree', $sponsor->id) }}">Paga</a>
            @endforeach
        </div>
    </div>
</div>
@endsection