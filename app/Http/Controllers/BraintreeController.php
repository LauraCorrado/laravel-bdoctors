<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Models\Sponsor;
use App\Models\DoctorSponsor;

class BraintreeController extends Controller
{
    // generate a Braintree client token
    public function token(Request $request, $sponsorId){
        // recupero lo sponsor selezionato
        $sponsor = Sponsor::findOrFail($sponsorId);

        $gateway = new Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env("BRAINTREE_MERCHANT_ID"),
            'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
            'privateKey' => env("BRAINTREE_PRIVATE_KEY")
        ]);
        $clientToken = $gateway->clientToken()->generate();

        // gestione pagamento se esiste nonce
        if($request->input('nonce') != null){
            // var_dump($request->input('nonce'));
            $nonceFromTheClient = $request->input('nonce');
        
            // salvo il risultato deella transazione di vendita
            $result = $gateway->transaction()->sale([
                //uso importo del pacchetto
                'amount' => $sponsor->price,
                'paymentMethodNonce' => $nonceFromTheClient,
                'options' => [
                    'submitForSettlement' => true
                ]
            ]);

            //verifica se pagamento è andato a buon fine
            if ($result->success) {
                //in caso, calcolo la data di scadenza in base alla durata della sponsorizzazione
                $expiringDate = now()->addHours($sponsor->duration);

                // sponsorizzazione per il medico
                $doctorId = auth()->user()->doctor->id;

                $doctorSponsor = new DoctorSponsor();
                $doctorSponsor->doctor_id = $doctorId;
                $doctorSponsor->sponsor_id = $sponsorId;
                $doctorSponsor->expiring_date = $expiringDate;
                $doctorSponsor->save();

                // in caso di successo redirect verso la dashboard o una pagina di conferma
                return redirect()->route('admin.doctors.show')->with('success', 'Pagamento completato e sponsorizzazione attivata!');
            } else {
                return back()->with('error', 'C\'è stato un problema nel pagamento. Riprova più tardi');
            }
        }

        return view('admin.doctors.braintree', ['token' => $clientToken, 'sponsor' => $sponsor]);
    }
}
