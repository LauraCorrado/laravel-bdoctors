<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sponsor;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsors = config('sponsor');
        foreach($sponsors as $sponsor){
            $new_sponsor = new Sponsor();
            $new_sponsor->package = $sponsor['package'];
            $new_sponsor->price = $sponsor['price'];
            $new_sponsor->duration = $sponsor['duration'];
            $new_sponsor->save();
        }
    }
}
