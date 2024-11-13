<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree\Gateway;

class BraintreeController extends Controller
{
    // generate a Braintree client token
    public function token(Request $request){

        $gateway = new Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env("BRAINTREE_MERCHANT_ID"),
            'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
            'privateKey' => env("BRAINTREE_PRIVATE_KEY")
        ]);
            $clientToken = $gateway->clientToken()->generate();
            return view ('admin.doctors.braintree',['token' => $clientToken]);
    }
}
