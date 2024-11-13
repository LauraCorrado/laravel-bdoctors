@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 text-center-mb-5">
            {{-- <h1>Rendi il tuo profilo più visibile</h1>
            <h4>Scegli uno dei seguenti pacchetti promozionali:</h4>
            <ul>
                <li>2,99 € per 24 ore di sponsorizzazione</li>
                <li>5,99 € per 72 ore di sponsorizzazione</li>
                <li>9,99 € per 144 ore di sponsorizzazione</li>
            </ul>
            <p>Per attivare la promozione, effettua il pagamento utilizzando questo form</p> --}}
            <form method="POST" action="{{ url('/admin/payment') }}" class="p-2">
                @csrf
                <div id="dropin-container" style="display: flex; justify-content-center; align-items: center;"></div>
                <div style="display: flex; justify-content: center; align-items: center; color: white;">
                    <button id="submit-button" class="btn btn-sm btn-success" type="submit">Conferma il pagamento</button>
                </div>
            </form>
        </div>
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

        // Gestisci l'evento di clic del pulsante una sola volta
        button.addEventListener('click', function () {
            instance.requestPaymentMethod(function (err, payload) {
                if (err) {
                    console.error('Error requesting payment method:', err);
                    return;
                }

                // Aggiungi il codice per inviare il nonce al server tramite Ajax
                console.log('Payment method nonce:', payload.nonce);

                // Esegui la richiesta Ajax per inviare il nonce al server
                (function($) {
                    $(function() {
                        // Imposta il token CSRF
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        // Invia la richiesta AJAX
                        $.ajax({
                            type: "POST",
                            url: "{{ route('admin.doctors.braintree') }}",  // Assicurati che la route esista
                            data: { nonce: payload.nonce },  // Invia il nonce
                            success: function (data) {
                                console.log('Payment success', data);
                            },
                            error: function (data) {
                                console.log('Payment error', data);
                            }
                        });
                    });
                })(jQuery);
            });
        });
    });
});
   
</script>
@endsection