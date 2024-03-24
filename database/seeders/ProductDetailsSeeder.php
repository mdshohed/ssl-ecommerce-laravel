<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $old_productDetails = DB::connection('mysql2')->table('product_details')->get();
        foreach( $old_productDetails as $productDetails){
            DB::connection('mysql')->table('product_details')->insert([
                'img1'=> $productDetails->img1,
                'img2'=> $productDetails->img2,
                'img3'=> $productDetails->img3,
                'img4'=> $productDetails->img4,
                'des'=> $productDetails->des,
                'color'=> $productDetails->color,
                'size'=> $productDetails->size,
                'product_id'=> $productDetails->product_id,
            ]);
        }
    }
}
