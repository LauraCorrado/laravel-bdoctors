<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Field;

class FieldController extends Controller
{
    public function index() {
        $fields = Field::all();
        return response()->json([
            'success' => true,
            'results' => $fields
        ]);
    }
}
