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

        if ($request->has('nonce')) {
            $nonceFromTheClient = $request->input('nonce');
        
            // salvo il risultato della transazione di vendita
            $result = $gateway->transaction()->sale([
                // uso l'importo del pacchetto
                'amount' => $sponsor->price,
                'paymentMethodNonce' => $nonceFromTheClient,
                'options' => [
                    'submitForSettlement' => true
                ]
            ]);

            /*// verifica se il pagamento è andato a buon fine
            if ($result->success) {
                // Calcolare la data di scadenza basata su created_at (usando Carbon)
                $expiringDate = Carbon::now()->addHours($sponsor->duration);

                // sponsorizzazione per il medico
                auth()->user()->doctor->sponsors()->attach($sponsorId, [
                    'expiring_date' => $expiringDate,
                ]);
                
                // In caso di successo, restituisci un messaggio
                return response()->json(['success' => true, 'message' => 'Pagamento completato. <br> Verrai reindirizzato a breve.']);
            } else {
                // Se c'è un errore nel pagamento, restituisci un errore
                return response()->json(['success' => false, 'error' => 'C\'è stato un errore nel pagamento. Riprova più tardi']);
            }*/

            if ($result->success) {
                $doctor = auth()->user()->doctor;
    
                // verifica se il medico ha sponsorizzazioni attive, prendendo la più recente
                $lastSponsor = $doctor->sponsors()->orderByDesc('expiring_date')->first();
                // verifico se esiste lastSponsor e se la sponsorizzazione è ancora attiva
                if ($lastSponsor && $lastSponsor->pivot->expiring_date > Carbon::now()) {
                    // Caso: sponsorizzazione attiva: vai in standby
                    $startDate = Carbon::parse($lastSponsor->pivot->expiring_date);
                } else {
                    // Caso: nessuna sponsorizzazione attiva
                    $startDate = Carbon::now();
                }
    
                // calcolo la data di scadenza
                $expiringDate = $startDate->copy()->addHours($sponsor->duration);
    
                
                $doctor->sponsors()->attach($sponsorId, [
                    'expiring_date' => $expiringDate,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
    
                return response()->json([
                    'success' => true,
                    'message' => 'Pagamento completato con successo! <br> Verrai reindirizzato a breve.',
                    'data' => [
                        'start_date' => $startDate,
                        'expiring_date' => $expiringDate
                    ]
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'error' => 'C\'è stato un errore nel pagamento. Riprova più tardi.'
                ]);
            }
        }

        // Se non c'è un nonce, passa il clientToken alla vista
        return view('admin.doctors.braintree', [
            'clientToken' => $clientToken,
            'sponsor' => $sponsor
        ]);
    }
}
