<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMessageRequest; 
use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function store(StoreMessageRequest $request)
    {
        // I dati sono già validati grazie al StoreMessageRequest
        $validated = $request->validated();

        // Creazione del messaggio
        $message = Message::create([
            'doctor_id' => $validated['doctor_id'],
            'name' => $validated['name'],
            'surname' => $validated['surname'],
            'email' => $validated['email'],
            'content' => $validated['content'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Messaggio inviato con successo!'
        ]);
    }
}
