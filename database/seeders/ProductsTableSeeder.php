<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('products')->truncate();
        
        $brands = \DB::table('brands')->get();
        $brandIds = $brands->pluck('id');
        
        $productCategoryIds = \DB::table('product_categories')->get()->pluck('id');
        
        
        $faker = \Faker\Factory::create();
        
        for($i = 1; $i <= 1000; $i++){
            \DB::table('products')->insert([
                'name' => $faker->city,
                'description' => $faker->realText(255),
                'brand_id' => $brandIds->random(),
                'product_category_id' => $productCategoryIds->random(),
                'index_page' => rand(100, 999) % 2,
                'price' => rand(100, 10000) / 100,
                'old_price' => rand(100, 10000) / 100,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
