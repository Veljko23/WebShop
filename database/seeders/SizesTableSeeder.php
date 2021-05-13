<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('sizes')->truncate();
        
        $sizeNames = ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL'];
        
        foreach ($sizeNames as $sizeName){
            \DB::table('sizes')->insert([
                'name' => $sizeName,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
