@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12 text-center mb-5">
            <!-- Messaggi di successo o errore -->
            @if (session('success'))
                <div class="alert alert-success">
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
        <div class="col-12 text-center-mb-5">
            {{-- <form method="POST" action="{{ route('admin.doctors.braintree', ['sponsorId' => $sponsor->id]) }}" class="p-2"> --}}
                @csrf
                <div id="dropin-container" style="display: flex; justify-content-center; align-items: center;"></div>
                <div style="display: flex; justify-content: center; align-items: center; color: white;">
                    <button id="submit-button" class="btn btn-sm btn-success">Conferma il pagamento</button>
                </div>
            {{-- </form> --}}
        </div>
    </div>
</div>

<script>

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
            console.log('Nonce:', payload.nonce);
            //imposta token csrf
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                //invio richiesta con nonce
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.doctors.braintree', ['sponsorId' => $sponsor->id]) }}",
                    data: {nonce: payload.nonce},
                    success: function (data) {
                        console.log('success', payload.nonce);
                        window.location.href = "{{ route('admin.doctors.show', ['doctor' => auth()->user()->doctor->slug]) }}"; // redirect dopo il pagamento
                    },
                    error: function (data) {
                        console.log('error', payload.nonce);
                        alert('C\'è stato un errore con il pagamento. Riprova più tardi.');
                    }
                });
            });
        });
    });
   
</script>
@endsection