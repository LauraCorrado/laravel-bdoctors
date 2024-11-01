<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Doctor;

class Message extends Model
{
    use HasFactory;

    // realazione OtM
    public function doctor() {
        return $this->belongsTo(Doctor::class);
    }
}