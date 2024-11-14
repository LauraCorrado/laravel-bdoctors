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
    public function token(Request $request, $sponsorId) {
        // Recupero lo sponsor selezionato
        $sponsor = Sponsor::findOrFail($sponsorId);
        $gateway = new Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env("BRAINTREE_MERCHANT_ID"),
            'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
            'privateKey' => env("BRAINTREE_PRIVATE_KEY")
        ]);

        // Genera il token
        $clientToken = $gateway->clientToken()->generate();

        // Se il pagamento è già stato completato (i.e., se c'è un nonce)
        if ($request->has('nonce')) {
            $nonceFromTheClient = $request->input('nonce');

            // Salvo il risultato della transazione di vendita
            $result = $gateway->transaction()->sale([
                'amount' => $sponsor->price,
                'paymentMethodNonce' => $nonceFromTheClient,
                'options' => [
                    'submitForSettlement' => true
                ]
            ]);

            // Verifica se il pagamento è andato a buon fine
            if ($result->success) {
                // Calcola la data di scadenza usando Carbon
                $expiringDate = Carbon::now()->addHours($sponsor->duration);

                // Sponsorizzazione per il medico
                auth()->user()->doctor->sponsors()->attach($sponsorId, [
                    'expiring_date' => $expiringDate,
                ]);

                // In caso di successo, aggiungi il messaggio alla sessione e fai il redirect
                return redirect()->route('admin.doctors.show', ['doctor' => auth()->user()->doctor->slug])
                                 ->with('success', 'Pagamento completato, sponsorizzazione attivata');
            } else {
                // Se c'è un errore nel pagamento, aggiungi il messaggio di errore alla sessione
                return redirect()->route('admin.doctors.show', ['doctor' => auth()->user()->doctor->slug])
                                 ->with('error', 'C\'è stato un errore nel pagamento. Riprova più tardi');
            }
        }

        // Se non c'è un nonce, passa il clientToken alla vista
        return view('admin.doctors.braintree', [
            'clientToken' => $clientToken,
            'sponsor' => $sponsor
        ]);
    }
}
