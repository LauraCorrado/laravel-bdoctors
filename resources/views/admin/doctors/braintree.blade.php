@extends('layouts.app')

@section('content')
<div class="py-2">
    @csrf
    <div id="dropin-container" style="display: flex; justify-content-center; align-items: center;"></div>
    <div style="display: flex; justify-content: center; align-items: center; color: white;">
        <a href="" id="submit-button" class="btn btn-sm btn-success">Conferma il pagamento</a>
    </div>

</div>
@endsection

@section('scripts')
<script>
    const button = document.querySelector('#submit-button');
        braintree.dropin.create({
            authorization: {{$token}},
            container: '#dropin-container',
        }, function (createErr, instance){
            button.addEventListener('click', function (){
                instance.requestPaymentMethod(function(err, payload{
                    }));
            })
        });
</script>
@endsection