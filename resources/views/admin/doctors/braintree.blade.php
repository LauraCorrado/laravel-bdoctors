@extends('layouts.app')
@section('title', 'BD - Pagamento')
@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12 title-pay">
            <h1 class="text-center fw-bolder">Effettua qua il tuo pagamento</h1>
            <h3 class="mb-5 text-center">Hai scelto il pacchetto <strong class="text-capitalize">{{$sponsor->package}}</strong>!</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center mb-5">
            <form method="POST" action="{{ route('admin.doctors.braintree', ['sponsorId' => $sponsor->id]) }}" class="p-2">
                @csrf
                <div class="d-flex justify-content-center">
                    <div id="dropin-container" class="drop-in p-4 d-flex justify-content-center align-items-center rounded"></div>
                </div>
                <div style="display: flex; justify-content: center; align-items: center; color: white;">
                    <button id="submit-button" class="deluxe-button my-4" {{ isset($paymentSuccess) || isset($paymentError) ? 'disabled' : '' }}>Conferma il pagamento</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row" style="display: none" id="alert_row">
        <div class="col-12 text-center mb-5">
            <div id="message-alert" style="display: none;" class="alert fw-bolder" role="alert"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="d-flex flex-column flex-md-row justify-content-center align-items-center">
                <a href="{{route('admin.sponsors.index')}}" class="back text-decoration-none text-center back-to-sponsors">Torna indietro</a>
                <a href="{{route('admin.dashboard')}}" class="back text-decoration-none text-center">Torna alla dashboard</a>
            </div>
        </div>
    </div>
</div>

<script>
let successAlert = document.getElementById('message-alert');
let alertRow = document.getElementById('alert_row');

const clientToken = "{{ $clientToken }}"
let button = document.querySelector('#submit-button');

//componente dropin
braintree.dropin.create({
    authorization: clientToken,
    container: '#dropin-container'
}, function (createErr, instance) {
    if (createErr) {
        console.error('Errore creazione Drop-in:', createErr);
        return;
    }
    button.addEventListener('click', function (e) {
        e.preventDefault();
        instance.requestPaymentMethod(function (err, payload) {
            if (err) {
                console.error('Errore richiesta metodo di pagamento:', err);
                return;
            }
            
            // Imposta token CSRF
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            button.disabled = true;

            // Invio richiesta con nonce
            $.ajax({
                type: "POST",
                url: "{{ route('admin.doctors.braintree', ['sponsorId' => $sponsor->id]) }}",
                data: { nonce: payload.nonce },
                success: function (data) {
                    successAlert.classList.remove('alert-well', 'alert-danger');
                    //successo
                    if (data.success) {
                            successAlert.classList.add('alert-well');
                            successAlert.innerHTML = data.message;
                        } else { //insuccesso
                            successAlert.classList.add('alert-danger');
                            successAlert.innerHTML = data.error;
                        }
                        successAlert.style.display = 'block';
                        alertRow.style.display = 'flex';
                        setTimeout(function() {
                        successAlert.style.display = 'none';
                        alertRow.style.display = 'none';
                        window.location.href = "{{ route('admin.doctors.show', ['doctor' => auth()->user()->doctor->slug]) }}";
                    }, 3000);
                },
                error: function (data) {
                    successAlert.classList.remove('alert-well', 'alert-danger');
                    successAlert.classList.add('alert-danger');
                        successAlert.innerHTML = "C'è stato un errore con il pagamento. Riprova più tardi.";
                        successAlert.style.display = 'block';
                        button.disabled = false;
                }
            });
        });
    });
});
</script>
@endsection
