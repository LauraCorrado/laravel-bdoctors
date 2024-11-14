<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class StatController extends Controller
{
    public function index()
    {
        return view('admin.stats.index');
    }
}
