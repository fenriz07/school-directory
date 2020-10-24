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
            'first_name' => 'Carlos',
            'last_name' => 'Javier',
            'email' => 'javier@impactum.mx',
            'password' => bcrypt('adminadmin'),
        ]);
    }
}
