<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\User;

use Faker\Factory as Faker;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $doctors = config('doctors');
        //per utenti fittizi associati
        $faker = Faker::create();

        foreach($doctors as $doctor){
            //user fittizi
            $user = User::create([
                'name' => $doctor['user_name'],
                'surname' => $doctor['user_surname'],
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password123')
            ]);

            $new_doctor = new Doctor();
            $new_doctor -> user_name = $doctor ['user_name'];
            $new_doctor -> user_surname = $doctor ['user_surname'];
            $new_doctor -> city = $doctor ['city'];
            $new_doctor -> address = $doctor ['address'];
            $new_doctor -> phone_number = $doctor ['phone_number'];
            $new_doctor -> cv = $doctor ['cv'];
            $new_doctor -> thumb = $doctor ['thumb'];
            $new_doctor -> performance = $doctor ['performance'];
            $new_doctor -> slug = Doctor::createSlug($doctor ['user_name'].' '.$doctor['user_surname']);
            
            $new_doctor->user_id = $user->id;
            $new_doctor -> save();
        }
    }
}
