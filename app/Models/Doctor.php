<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Field;
use Illuminate\Support\Str;

class Doctor extends Model
{
    use HasFactory;

    public static function createSlug($name) {
        return Str::slug($name, '-');
    }

    //relazione MtM
    public function fields() {
        return $this->belongsToMany(Field::class);
    }
}
