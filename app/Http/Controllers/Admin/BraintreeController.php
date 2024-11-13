<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Models\Sponsor;
use Carbon\Carbon; 

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
        // genera token
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

            // verifica se pagamento è andato a buon fine
            if ($result->success) {
                // Calcolare la data di scadenza basata su created_at (usando Carbon)
                // Ad esempio, se la durata è espressa in ore, aggiungiamo le ore a created_at
                $expiringDate = Carbon::now()->addHours($sponsor->duration);

                // sponsorizzazione per il medico
                $doctorId = auth()->user()->doctor->id;
                
                // Aggiungi direttamente alla tabella pivot `doctor_sponsor`
                auth()->user()->doctor->sponsors()->attach($sponsorId, [
                    'expiring_date' => $expiringDate, // Salva la data di scadenza nella pivot
                ]);
                
                // In caso di successo, redirect verso la dashboard o una pagina di conferma
                return redirect()->route('admin.doctors.show', $doctorId)
                    ->with('success', 'Pagamento completato e sponsorizzazione attivata!');
            } else {
                return back()->with('error', 'C\'è stato un problema nel pagamento. Riprova più tardi');
            }
        }
        
        return view('admin.doctors.braintree', ['token' => $clientToken, 'sponsor' => $sponsor]);
    }
}
