<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class StatController extends Controller
{
    public function index()
    {
        $doctor = Auth::user()->doctor;
        
        if (!$doctor) {
            abort(404, 'Pagina non trovata.');
        }
        
        // Numero totale di messaggi
        $messageCount = Message::where('doctor_id', $doctor->id)
                            ->whereYear('created_at', now()->year)
                            ->whereMonth('created_at', now()->month)
                            ->count();
        
        // Numero totale di recensioni
        $reviewCount = Review::where('doctor_id', $doctor->id)
                            ->whereYear('created_at', now()->year)
                            ->whereMonth('created_at', now()->month)
                            ->count();
        
        // Numero di voti per il mese corrente
        $totalVotes = Review::where('doctor_id', $doctor->id)
                            ->whereYear('created_at', now()->year)
                            ->whereMonth('created_at', now()->month)
                            ->whereNotNull('vote')
                            ->count();
        
        // Recupera la media dei voti
        $averageRating = Review::where('doctor_id', $doctor->id)
                            ->whereYear('created_at', now()->year)
                            ->whereMonth('created_at', now()->month)
                            ->avg('vote');

        // Passa i dati alla vista
        return view('admin.stats.index', compact('messageCount', 'reviewCount', 'totalVotes', 'averageRating'));
    }

}