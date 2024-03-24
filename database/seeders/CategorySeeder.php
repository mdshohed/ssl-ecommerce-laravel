<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // for($i = 0; $i<20; $i++){
        //     $category = new Category;
        //     $category->categoryName = fake()->name;
        //     $category->categoryImg = fake()->imageUrl(360, 360, 'animals', true, 'dogs', true, 'jpg');
        //     $category->save();
        // }
        $old_category = DB::connection('mysql2')->table('categories')->get();
        foreach( $old_category as $category){
            DB::connection('mysql')->table('categories')->insert([
                'categoryName'=> $category->categoryName,    
                'categoryImg'=> $category->categoryImg, 
            ]);
        }
    }
}
