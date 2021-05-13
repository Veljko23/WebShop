<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductSizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('product_sizes')->truncate();
        
        $sizeIds = \DB::table('sizes')->get()->pluck('id');
        
        $productIds = \DB::table('products')->get()->pluck('id');
        
        foreach($productIds as $productId){
            $randomSizeIds = $sizeIds->random(3);
        
            
            foreach($randomSizeIds as $sizeId){
                \DB::table('product_sizes')->insert([
                    'product_id' => $productId,
                    'size_id' => $sizeId,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }
        
    }
}
