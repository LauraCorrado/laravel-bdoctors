<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $user = Auth::user();
        $doctor = Doctor::where('user_id', $user->id)->first();
        
        return view('admin.dashboard', compact('doctor'));
    }
}
