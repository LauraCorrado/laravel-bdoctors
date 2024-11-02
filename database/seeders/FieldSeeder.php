<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Field;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fields = config('fields');
        foreach($fields as $field) {
            $new_field = new Field();
            $new_field->name = $field;
            $new_field->save();
        }
        
    }
}
