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

        // Se non viene dato un voto imposta 0 di default
        $vote = $validated['vote'] ?? 0;
        // Se il nome non è presente imposta "Utente" di default
        $name = $validated['name'] ?? 'Utente';
        
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
