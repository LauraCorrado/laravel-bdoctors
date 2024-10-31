<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Doctor;
use Faker\Generator as Faker;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i=0; $i<20; $i++) {
            $new_doctor = new Doctor();
            $new_doctor->slug = Doctor::createSlug($new_doctor->user_surname . $new_doctor->user_name);
            $new_doctor->user_name = $faker->firstName();
            $new_doctor->user_surname = $faker->lastName();
            $new_doctor->city = $faker->city();
            $new_doctor->address = $faker->address();
            $new_doctor->phone_number = $faker->phoneNumber();
            $new_doctor->cv = $faker->mimeType();
            $new_doctor->thumb = $faker->imageUrl(640, 480, 'animals', true);
            $new_doctor->performance = $faker->paragraph();

            $new_doctor->save();
        }
    }
}
