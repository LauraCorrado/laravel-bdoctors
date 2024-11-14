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
        $messageCount = Message::where('doctor_id', $doctor->id)->count();

        // Numero totale di recensioni e media dei voti
        $reviewCount = Review::where('doctor_id', $doctor->id)->count();
        $totalVotes = Review::where('doctor_id', $doctor->id)->whereNotNull('vote')->count();
        $averageRating = Review::where('doctor_id', $doctor->id)->avg('vote');

        // Passa i dati alla vista
        return view('admin.stats.index', compact('messageCount', 'reviewCount', 'averageRating', 'totalVotes'));
    }
}
