<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('product_categories')->truncate();
        
        $faker = \Faker\Factory::create();
        
        for($i = 1; $i <= 5; $i++){
            \DB::table('product_categories')->insert([
                'priority' => $i,
                'name' => $faker->city,
                'description' => $faker->realText(),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
