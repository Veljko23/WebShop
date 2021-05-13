<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        \DB::table('brands')->truncate();
        $faker = \Faker\Factory::create();

        for ($i = 1; $i <= 10; $i++) {
            \DB::table('brands')->insert([
                'name' => $faker->company,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }

}
