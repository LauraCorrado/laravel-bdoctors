<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $user = Auth::user();
        $doctor = Doctor::where('user_id', $user->id)->first();
        $messages = $doctor ? Message::where('doctor_id', $doctor->id)->get() : collect();
        return view('admin.dashboard', compact('doctor', 'messages'));
    }
}
