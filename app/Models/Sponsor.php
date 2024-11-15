<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Doctor;

class Sponsor extends Model
{
    use HasFactory;

    protected $fillable = ['package', 'price', 'duration'];

    // relazione MtM
    public function doctors(){
        return $this->belongsToMany(Doctor::class)->withPivot('expiring_date')->withTimestamps();;
    }
}
