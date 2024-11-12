<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request)
    {
       
        $validated = $request->validated();

        // Crea un nome casuale se campo name è vuoto
        if (empty($validated['name'])) {
            $validated['name'] = 'Utente' . rand(1000, 9999);
        }

        // Se il voto non è presente imposto 0 di default
        if (!isset($validated['vote'])) {
            $validated['vote'] = 0;
        }
        
        $review = Review::create([
            'doctor_id' => $validated['doctor_id'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'content' => $validated['content'],
            'vote' => $validated['vote']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Recensione inviata con successo!',
            'review' => $review 
            
        ]);
    }
}
