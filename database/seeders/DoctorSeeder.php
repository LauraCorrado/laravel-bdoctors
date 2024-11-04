<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Doctor;

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
        foreach($doctors as $doctor){
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
            $new_doctor -> save();
        }
    }
}
