<?php

use Illuminate\Database\Seeder;
use App\Models\Level;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Level::create( ['name' => 'Maternal'] );
        Level::create( ['name' => 'Prefirst'] );
        Level::create( ['name' => 'Primaria'] );
        Level::create( ['name' => 'Secundaria'] );
    }
}
