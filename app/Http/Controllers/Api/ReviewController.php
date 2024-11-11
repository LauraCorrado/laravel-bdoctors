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

        
        $review = Review::create([
            'doctor_id' => $validated['doctor_id'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'content' => $validated['content'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Recensione inviata con successo!',
            'review' => $review 
            
        ]);
    }
}
