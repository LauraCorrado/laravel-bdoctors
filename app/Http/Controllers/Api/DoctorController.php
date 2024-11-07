<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Field;

class DoctorController extends Controller
{
    
    // public function index()
    // {
    //     $doctors = Doctor::with('fields')->paginate(6);
    //     return response()->json([
    //         'success' => true,
    //         'results' => $doctors
    //     ]);
    // }

    public function index(Request $request) {
        $query = Doctor::with('fields');
    
        // Filtra per specializzazione
        if ($request->has('fields')) {
            $fields = $request->input('fields');
            $query->whereHas('fields', function ($qu) use ($fields) {
                $qu->whereIn('name', $fields);
            });
        }
        $doctors = $query->paginate(6);
        return response()->json([
            'success' => true,
            'results' => $doctors
        ]);
    }
}
