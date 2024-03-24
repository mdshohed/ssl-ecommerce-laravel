<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ProductSliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $old_productSlider = DB::connection('mysql2')->table('product_sliders')->get();
        foreach( $old_productSlider as $productSlider){
            DB::connection('mysql')->table('product_sliders')->insert([
                'title'=> $productSlider->title,
                'short_des'=> $productSlider->short_des,
                'price'=> $productSlider->price,
                'image'=> $productSlider->image,
                'product_id'=> $productSlider->product_id,
            ]);
        }
    }
}
