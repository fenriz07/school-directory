<?php

use Illuminate\Database\Seeder;
use App\Models\Post;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $content = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae sunt, voluptate ex explicabo doloribus eaque architecto eum repellendus ad. Fugiat rem alias, minima quam hic aliquam assumenda neque impedit tempora.';

        Post::create([
            'title' => 'Noticia 1',
            'slug' => 'noticia-1',
            'content'=> $content,
            'type' => 'news',
        ]);

        Post::create([
            'title' => 'Noticia 2',
            'slug' => 'noticia-2',
            'content'=> $content,
            'type' => 'news',
        ]);

        Post::create([
            'title' => 'Noticia 3',
            'slug' => 'noticia-3',
            'content'=> $content,
            'type' => 'news',
        ]);

    }
}
