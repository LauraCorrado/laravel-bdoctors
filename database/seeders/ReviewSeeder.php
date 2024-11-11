<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // recensioni
        $reviews = config('reviews');

        foreach($reviews as $review){
            $new_review = new Review();
            $new_review->name = $review['name'];
            $new_review->email = $review['email'];
            $new_review->content = $review['content'];
            $new_review->doctor_id = $review['doctor_id'];
            $new_review->save();
        }
    }
}
