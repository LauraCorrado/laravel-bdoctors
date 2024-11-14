@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12 text-center mb-5">
            <!-- Messaggi di successo o errore -->
            @if (session('success'))
                <div class="alert alert-success" id="success-alert">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center mb-5">
            <form method="POST" action="{{ route('admin.doctors.braintree', ['sponsorId' => $sponsor->id]) }}" class="p-2">
                @csrf
                <div class="d-flex justify-content-center">
                    <div id="dropin-container" style="display: flex; justify-content-center; align-items: center;"></div>
                </div>
                <div style="display: flex; justify-content: center; align-items: center; color: white;">
                    <button id="submit-button" class="btn btn-sm btn-success">Conferma il pagamento</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Timer per far scomparire il messaggio di successo dopo 5 secondi
    document.addEventListener('DOMContentLoaded', function () {
        let successAlert = document.getElementById('success-alert');
        if (successAlert) {
            setTimeout(function () {
                successAlert.style.display = 'none';
            }, 5000); // 5000 ms = 5 secondi
        }
    });

    const clientToken = "{{ $clientToken }}"
    let button = document.querySelector('#submit-button');

    braintree.dropin.create({
        authorization: clientToken,
        container: '#dropin-container'
    }, function (createErr, instance) {
        if (createErr) {
            console.error('Error creating Braintree Drop-in:', createErr);
            return;
        }
        button.addEventListener('click', function (e) {
            e.preventDefault();
            instance.requestPaymentMethod(function (err, payload) {
                if (err) {
                    console.error('Error requesting payment method:', err);
                    return;
                }
                
                // Imposta token CSRF
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                
                // Invio richiesta con nonce
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.doctors.braintree', ['sponsorId' => $sponsor->id]) }}",
                    data: { nonce: payload.nonce },
                    success: function (data) {
                        // Reindirizza alla pagina finale dopo il pagamento
                        window.location.href = "{{ route('admin.doctors.show', ['doctor' => auth()->user()->doctor->slug]) }}";
                    },
                    error: function (data) {
                        alert('C\'è stato un errore con il pagamento. Riprova più tardi.');
                    }
                });
            });
        });
    });
</script>
@endsection
