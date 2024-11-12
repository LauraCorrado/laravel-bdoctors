<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use App\Models\Doctor;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request, $slug)
    {
        // Trova il dottore tramite lo slug
        $doctor = Doctor::where('slug', $slug)->first();
        
        if (!$doctor) {
            // Se il dottore non esiste, restituisci un errore 404
            return response()->json([
                'success' => false,
                'message' => 'Dottore non trovato.'
            ], 404);
        }

        // Valida i dati della recensione
        $validated = $request->validated();

        // Crea un nome casuale se il campo "name" è vuoto
        if (empty($validated['name'])) {
            $validated['name'] = 'Utente' . rand(1000, 9999);
        }

        // Se il voto non è presente, imposta 0 di default
        if (!isset($validated['vote'])) {
            $validated['vote'] = 0;
        }

        // Crea la recensione associandola al dottore trovato
        $review = Review::create([
            'doctor_id' => $doctor->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'content' => $validated['content'],
            'vote' => $validated['vote']
        ]);

        // Risposta di successo
        return response()->json([
            'success' => true,
            'message' => 'Recensione inviata con successo!',
            'review' => $review
        ]);
    }
}
