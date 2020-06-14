<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        Category::create([
            'name' => 'Matematicas',
            'slug' => str_slug('Matematicas'),
            'icon' => 'fa-glass',
            'icon_color' => null,
            'icon_bgcolor' => null,
            'parent_id' => null,
            'order'  => 0,
        ]);

        Category::create([
            'name' => 'Hijo 1',
            'slug' => str_slug('Hijo 1'),
            'icon' => 'fa-glass',
            'icon_color' => null,
            'icon_bgcolor' => null,
            'parent_id' => 1,
            'order'  => 0,
        ]);


        Category::create([
            'name' => 'Hijo 2',
            'slug' => str_slug('Hijo 2'),
            'icon' => 'fa-glass',
            'icon_color' => null,
            'icon_bgcolor' => null,
            'parent_id' => 1,
            'order'  => 0,
        ]);

        Category::create([
            'name' => 'Hijo 3',
            'slug' => str_slug('Hijo 3'),
            'icon' => 'fa-glass',
            'icon_color' => null,
            'icon_bgcolor' => null,
            'parent_id' => 1,
            'order'  => 0,
        ]);


        Category::create([
            'name' => 'Castellano',
            'slug' => str_slug('Castellano'),
            'icon' => 'fa-glass',
            'icon_color' => null,
            'icon_bgcolor' => null,
            'parent_id' => null,
            'order'  => 0,
        ]);


        Category::create([
            'name' => 'Historia',
            'slug' => str_slug('Historia'),
            'icon' => 'fa-glass',
            'icon_color' => null,
            'icon_bgcolor' => null,
            'parent_id' => null,
            'order'  => 0,
        ]);


        Category::create([
            'name' => 'Biologia',
            'slug' => str_slug('Biologia'),
            'icon' => 'fa-glass',
            'icon_color' => null,
            'icon_bgcolor' => null,
            'parent_id' => null,
            'order'  => 0,
        ]);

        Category::create([
            'name' => 'Ingles',
            'slug' => str_slug('Ingles'),
            'icon' => 'fa-glass',
            'icon_color' => null,
            'icon_bgcolor' => null,
            'parent_id' => null,
            'order'  => 0,
        ]);
    }
}
