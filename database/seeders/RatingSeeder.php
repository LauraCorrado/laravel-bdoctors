<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    }
}

// use App\Models\Doctor;
// use App\Models\Rating;

// public function run()
// {
//     $ratingsData = [
//         ["doctor_id" => 1, "ratings" => [4, 5, 3, 5]],
//         ["doctor_id" => 2, "ratings" => [2, 4, 4, 1, 3]],
//         ["doctor_id" => 3, "ratings" => [3, 5, 2]],
//         // Aggiungi gli altri medici qui
//     ];

//     foreach ($ratingsData as $data) {
//         $doctor = Doctor::find($data['doctor_id']);
//         foreach ($data['ratings'] as $ratingValue) {
//             // Crea una nuova valutazione e associa al medico
//             $rating = Rating::create([
//                 'value' => $ratingValue // Assumendo che Rating abbia un campo "value"
//             ]);
//             $doctor->ratings()->attach($rating->id); // Associa la valutazione al medico
//         }
//     }
// }
