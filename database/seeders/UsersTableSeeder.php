<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->truncate();
        
        \DB::table('users')->insert([
            'name' => 'Veljko Radic',
            'email' => 'veljko23r@gmail.com',
            'password' => \Hash::make('230295'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            
        ]);
        \DB::table('users')->insert([
            'name' => 'Ivo Ivicic',
            'email' => 'ivo@gmail.com',
            'password' => \Hash::make('230295'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            
        ]);
    }
}
