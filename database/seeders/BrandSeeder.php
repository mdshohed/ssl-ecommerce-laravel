<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;


class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // for($i = 0; $i<20; $i++){
        //     $brand = new Brand;
        //     $brand->brandName= fake()->name;
        //     // $brand->brandImg= Str::random('6');
        //     $brand->brandImg= fake()->imageUrl(360, 360, 'animals', true, 'dogs', true, 'jpg');
        //     $brand->save();
        // }
        $old_brand = DB::connection('mysql2')->table('brands')->get();
        foreach( $old_brand as $brand){
            DB::connection('mysql')->table('brands')->insert([
                'brandName'=> $brand->brandName,    
                'brandImg'=> $brand->brandImg, 
                // 'created_at'=> $brand->created_at,   
                // 'updated_at'=> $brand-> updated_at,
            ]);
        }
    }
}
