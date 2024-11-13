<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSponsor extends Model
{
    use HasFactory;

    protected $fillable = ['doctor_id', 'sponsor_id', 'expiring_date'];
    // relazioni di appartenenza
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function sponsor()
    {
        return $this->belongsTo(Sponsor::class);
    }
}
