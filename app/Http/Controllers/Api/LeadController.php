<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewContact;
use Illuminate\Http\Request;
use App\Models\Lead;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class LeadController extends Controller
{
    public function store(Request $request) {
        $data = $request->all();

        $new_lead = new Lead();
        $new_lead->fill($data);

        $new_lead->save();

        Mail::to('info@bdoctors.com')->send(new NewContact($new_lead));

        return response()->json([
            'success' => true
        ]);
    }
}
