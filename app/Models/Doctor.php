<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Field;
use App\Models\Review;
use App\Models\User;
use App\Models\Message;
use App\Models\Sponsor;
use Illuminate\Support\Str;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = ['user_name', 'user_surname', 'city', 'address', 'phone_number', 'performance', 'slug', 'thumb', 'cv', 'average_rating'];

    public static function createSlug($name) {
        return Str::slug($name, '-');
    }

    //relazione MtM
    public function fields() {
        return $this->belongsToMany(Field::class);
    }

    // realazione OtM
    public function reviews() {
        return $this->hasMany(Review::class);
    }

    // relazione OtO
    public function user(){
        return $this->belongsTo(User::class);
    }

    // realazione OtM
    public function messages() {
        return $this->hasMany(Message::class);
    }

    // relazione MtM
    public function sponsors(){
        return $this->belongsToMany(Sponsor::class);
    }
}
