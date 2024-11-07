<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Field;

class DoctorController extends Controller
{
    
    public function index()
    {
        $doctors = Doctor::with('fields')->get();
        return response()->json([
            'success' => true,
            'results' => $doctors
        ]);
    }

    public function getFields() {
        $fields = Field::all();
        return response()->json([
            'success' => true,
            'results' => $fields
        ]);
    }

    // public function searchByFields(Request $request) {
    //     // inizializziamo una query per Doctor
    //     $query = Doctor::query();

    //     // --- FILTRO ----
    //     if($request->filled('field')) {
    //         // whereHas per filtrare in base a relazione esistente
    //         $query->whereHas('fields', function ($qu) use ($request) {
    //             $qu->where('name', 'like')
    //         })
    //     }
    // }
}
