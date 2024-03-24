<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Brand::factory(10)->create();
        $this->call([
            // BrandSeeder::class,
            // CategorySeeder::class,
            // ProductSeeder::class,
            InvoiceSeeder::class,
            // InvoiceProductSeeder::class,
            PoliciesSeeder::class,
            ProductCartsSeeder::class,
            ProductDetailsSeeder::class,
            ProductSliderSeeder::class,
            ProductWishesSeeder::class,
            ProductReviewSeeder::class,
        ]);
    }
}
