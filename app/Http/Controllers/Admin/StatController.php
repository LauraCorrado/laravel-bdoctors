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
        
        // recupera i messaggi per ogni mese ed ogni anno
        $totalMessages = Message::where('doctor_id', $doctor->id)
                                ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
                                ->groupBy('year', 'month')
                                ->orderBy('year', 'desc')
                                ->orderBy('month', 'desc')
                                ->get();

        // Numero totale di recensioni e media dei voti
        $reviewCount = Review::where('doctor_id', $doctor->id)->count();
        $totalVotes = Review::where('doctor_id', $doctor->id)->whereNotNull('vote')->count();
        $averageRating = Review::where('doctor_id', $doctor->id)->avg('vote');
    
        // Recupera i dati per voti (1, 2, 3, 4, 5) per ogni mese e anno
        $voteCounts = Review::where('doctor_id', $doctor->id)
                            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, vote, COUNT(*) as count')
                            ->whereNotNull('vote')
                            ->groupBy('year', 'month', 'vote')
                            ->orderBy('year', 'desc')
                            ->orderBy('month', 'desc')
                            ->get();
    
        // Prepara i dati per il grafico (5 barre per voto: 1, 2, 3, 4, 5)
        $labels = [];
        $data = [
            '1' => [],
            '2' => [],
            '3' => [],
            '4' => [],
            '5' => []
        ];
    
        // Raggruppiamo i dati per mese e anno
        foreach ($voteCounts as $vote) {
            $monthYear = $vote->year . '-' . str_pad($vote->month, 2, '0', STR_PAD_LEFT); // 'YYYY-MM'
            
            if (!in_array($monthYear, $labels)) {
                $labels[] = $monthYear;
            }
    
            // Aggiungiamo i contatori per ogni voto (1, 2, 3, 4, 5)
            $data[$vote->vote][] = $vote->count;
        }
    
        // raggruppiamo i messaggi per mese e per anno
        

        // Filler per i mesi che non hanno un voto
        foreach ($data as $vote => $counts) {
            // Completa i mesi con zero se non esistono recensioni per quel voto
            foreach ($labels as $label) {
                if (!in_array($label, array_keys($counts))) {
                    $data[$vote][] = 0;
                }
            }
        }
    
        // Passa i dati alla vista
        return view('admin.stats.index', compact('messageCount', 'reviewCount', 'averageRating', 'totalVotes', 'labels', 'data'));
    }
    

}
