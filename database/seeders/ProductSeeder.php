<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // for($i = 0; $i<20; $i++){
        //     $product = new Product();
        //     $product->title = fake()->name;
        //     $product->short_des =
        //     $product->price =
        //     $product->discount = Str::random('100')
        //     $product->discount_price = Str::random('100')
        //     $product->image =
        //     $product->stock =
        //     $product->star =
        //     $product->new =
        //     $product->product_id =
        //     $product->brand_id =
        //     $product->save();
        // }
        $old_product = DB::connection('mysql2')->table('products')->get();
        foreach( $old_product as $product){
            DB::connection('mysql')->table('products')->insert([
                'title'=> $product->title,
                'short_des'=> $product->short_des,
                'price'=> $product->price,
                'discount'=> $product->discount,
                'discount_price'=> $product->discount_price,
                'image'=> $product->image,
                'stock'=> $product->stock,
                'star'=> $product->star,
                'remark'=> $product->remark,
                'category_id'=> $product->category_id,
                'brand_id'=> $product->brand_id,
            ]);
        }
    }
}
