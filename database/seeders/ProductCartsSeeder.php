<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCartsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $old_productCart = DB::connection('mysql2')->table('product_carts')->get();
        foreach( $old_productCart as $productCart){
            DB::connection('mysql')->table('product_carts')->insert([
                'qty'=> $productCart->qty,
                'price'=> $productCart->price,
                'color'=> $productCart->color,
                'size'=> $productCart->size,
                'product_id'=> $productCart->product_id,
                'user_id'=> $productCart->user_id,
            ]);
        }
    }
}
