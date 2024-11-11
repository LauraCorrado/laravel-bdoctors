<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Doctor;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'content',
        'doctor_id'
    ];

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }
}