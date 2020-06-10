<?php

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

        DB::table('users')->insert([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('adminadmin'),
        ]);

        DB::table('users')->insert([
            'first_name' => 'Servio',
            'last_name' => 'Zambrano',
            'email' => 'szambrano@example.com',
            'password' => bcrypt('adminadmin'),
        ]);


        DB::table('users')->insert([
            'first_name' => 'Carlos',
            'last_name' => 'Javier',
            'email' => 'cjavier@example.com',
            'password' => bcrypt('adminadmin'),
        ]);
    }
}
