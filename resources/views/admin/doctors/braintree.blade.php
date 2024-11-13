@extends('layouts.app')

@section('content')
    <div class="py-2">
        @csrf
        <div id="dropin-container" style="display: flex; justify-content-center; align-items: center;"></div>
        <div style="display: flex; justify-content: center; align-items: center; color: white;">
            <a id="submit-button" class="btn btn-sm btn-success" href="{{route('token')}}">Conferma il pagamento</a>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const button = document.querySelector('#submit-button');

            braintree.dropin.create({
                authorization: "{{ $token }}",  // Assicurati che $token contenga un valore stringa valido
                container: '#dropin-container',
            }, function (createErr, instance) {
                if (createErr) {
                    console.error('Error creating Braintree Drop-in:', createErr);
                    return;
                }

                button.addEventListener('click', function () {
                    instance.requestPaymentMethod(function (err, payload) {  // Chiudi correttamente le parentesi
                        if (err) {
                            console.error('Error requesting payment method:', err);
                            return;
                        }

                        // Aggiungi qui il codice per gestire il payload
                        console.log('Payment method nonce:', payload.nonce);
                        // Invia il nonce al server tramite un'API POST o un form
                    });
                });
            });
        });
    </script>
@endsection
