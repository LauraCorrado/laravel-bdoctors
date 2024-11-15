<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Field;
use App\Models\Review;
use App\Models\Sponsor;

class DoctorController extends Controller
{
    public function index(Request $request) {
        $doctors = Doctor::with(['fields', 'reviews', 'sponsors'])->get();
        return response()->json([
            'success' => true,
            'results' => $doctors
        ]);
    }

    public function details($slug) {
        $doctor = Doctor::with(['fields', 'reviews', 'sponsors'])->where('slug', $slug)->first();
        if($doctor) {
            return response()->json([
                'success' => true,
                'results' => $doctor
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Dottore non trovato'
        ]);
    }

    //ricevere e aggiornare media voti
    public function updateAvgRating(Request $request, $slug)
    {
        $validated = $request->validate([
            'averageRating' => 'required|numeric|min:0|max:5',
        ]);

        $doctor = Doctor::where('slug', $slug)->firstOrFail();
        
        $doctor->average_rating = $validated['averageRating'];
        $doctor->save();

        return response()->json([
            'success' => true,
            'message' => 'Media dei voti aggiornata con successo!'
        ]);
    }

    // salvo recensione con calcolo media
    public function storeReview(Request $request, $slug)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:150',
            'email' => 'required|email|max:150',
            'content' => 'required|string',
            'vote' => 'required|numeric|min:0|max:5',
        ]);

        $doctor = Doctor::where('slug', $slug)->firstOrFail();

        // nuova recensione
        $review = new Review();
        $review->doctor_id = $doctor->id;
        $review->name = $validated['name'] ?? 'Utente' . rand(1000, 9999);
        $review->email = $validated['email'];
        $review->content = $validated['content'];
        $review->vote = $validated['vote'];
        $review->save();

        // ricalcolo della media
        $averageRating = $doctor->reviews->avg('vote');

        // upodate media dei voti nella riga del doctor
        $doctor->average_rating = $averageRating;
        $doctor->save();

        return response()->json([
            'success' => true,
            'review' => $review,
            'average_rating' => $doctor->average_rating
        ]);
    }
}
