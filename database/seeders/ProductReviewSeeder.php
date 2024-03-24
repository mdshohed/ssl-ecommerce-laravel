<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $old_review = DB::connection('mysql2')->table('product_reviews')->get();
               foreach( $old_review as $review){
                   DB::connection('mysql')->table('product_reviews')->insert([
                       'description'=> $review->description,
                       'rating'=> $review->rating,
                       'product_id'=> $review->product_id,
                       'customer_id'=> $review->customer_id,
                   ]);
               }
    }
}
