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
    
        // Numero totale di messaggi, recensioni, e voti per il mese corrente
        $messageCount = Message::where('doctor_id', $doctor->id)
                               ->whereYear('created_at', now()->year)
                               ->whereMonth('created_at', now()->month)
                               ->count();
    
        $reviewCount = Review::where('doctor_id', $doctor->id)
                             ->whereYear('created_at', now()->year)
                             ->whereMonth('created_at', now()->month)
                             ->count();
    
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
    
        // Distribuzione dei voti per il mese corrente
        $voteDistribution = [
            1 => Review::where('doctor_id', $doctor->id)
                      ->whereYear('created_at', now()->year)
                      ->whereMonth('created_at', now()->month)
                      ->where('vote', 1)
                      ->count(),
            2 => Review::where('doctor_id', $doctor->id)
                      ->whereYear('created_at', now()->year)
                      ->whereMonth('created_at', now()->month)
                      ->where('vote', 2)
                      ->count(),
            3 => Review::where('doctor_id', $doctor->id)
                      ->whereYear('created_at', now()->year)
                      ->whereMonth('created_at', now()->month)
                      ->where('vote', 3)
                      ->count(),
            4 => Review::where('doctor_id', $doctor->id)
                      ->whereYear('created_at', now()->year)
                      ->whereMonth('created_at', now()->month)
                      ->where('vote', 4)
                      ->count(),
            5 => Review::where('doctor_id', $doctor->id)
                      ->whereYear('created_at', now()->year)
                      ->whereMonth('created_at', now()->month)
                      ->where('vote', 5)
                      ->count(),
        ];
    
        // Distribuzione dei voti per mese nell'anno corrente
        $monthlyVoteDistribution = [];
        foreach (range(1, 12) as $month) {
            $monthlyVoteDistribution[$month] = [
                1 => Review::where('doctor_id', $doctor->id)
                          ->whereYear('created_at', now()->year)
                          ->whereMonth('created_at', $month)
                          ->where('vote', 1)
                          ->count(),
                2 => Review::where('doctor_id', $doctor->id)
                          ->whereYear('created_at', now()->year)
                          ->whereMonth('created_at', $month)
                          ->where('vote', 2)
                          ->count(),
                3 => Review::where('doctor_id', $doctor->id)
                          ->whereYear('created_at', now()->year)
                          ->whereMonth('created_at', $month)
                          ->where('vote', 3)
                          ->count(),
                4 => Review::where('doctor_id', $doctor->id)
                          ->whereYear('created_at', now()->year)
                          ->whereMonth('created_at', $month)
                          ->where('vote', 4)
                          ->count(),
                5 => Review::where('doctor_id', $doctor->id)
                          ->whereYear('created_at', now()->year)
                          ->whereMonth('created_at', $month)
                          ->where('vote', 5)
                          ->count(),
            ];
        }
    
        // Passa i dati alla vista
        return view('admin.stats.index', compact('messageCount', 'reviewCount', 'totalVotes', 'averageRating', 'voteDistribution', 'monthlyVoteDistribution'));
    }
    
}
