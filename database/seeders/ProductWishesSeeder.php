<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductWishesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $old_productWishes = DB::connection('mysql2')->table('product_wishes')->get();
        foreach( $old_productWishes as $productWishes){
            DB::connection('mysql')->table('product_wishes')->insert([
                'product_id'=> $productWishes->product_id,
                'user_id'=> $productWishes->user_id,
            ]);
        }
    }
}
