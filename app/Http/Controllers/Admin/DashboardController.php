<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon; 

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $doctor = Doctor::where('user_id', $user->id)->first();
        $messages = $doctor ? Message::where('doctor_id', $doctor->id)->get() : collect();
        $averageRating = $doctor ? $doctor->reviews()->avg('vote') : 0;

        // data di scadenza dell'ultima sponsorizzazione attiva
        $sponsorExpiration = null;
        if ($doctor && $doctor->sponsors && $doctor->sponsors->isNotEmpty()) {
            $lastSponsor = $doctor->sponsors()->orderByDesc('pivot_expiring_date')->first();
            if ($lastSponsor && Carbon::parse($lastSponsor->pivot->expiring_date)->isFuture()) {
                $sponsorExpiration = Carbon::parse($lastSponsor->pivot->expiring_date)->setTimezone('Europe/Rome');
            }
        }

        return view('admin.dashboard', compact('doctor', 'messages', 'averageRating', 'sponsorExpiration'));
    }
}
