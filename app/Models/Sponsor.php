<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Doctor;

class Sponsor extends Model
{
    use HasFactory;

    // relazione MtM
    public function doctors(){
        return $this->belongsToMany(Doctor::class)->using(DoctorSponsor::class)->withPivot('expiring_date');
    }
}
