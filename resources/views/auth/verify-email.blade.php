@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifica il tuo indirizzo e-mail') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('Un nuovo link di verifica è stato inviato al tuo indirizzo e-mail.') }}
                    </div>
                    @endif

                    {{ __('Prima di procedere, controlla che nella tua mail sia presente il link di verifica') }}
                    {{ __('Se non hai ricevuto la mail') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __("clicca qui per richiederne un'altra") }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
