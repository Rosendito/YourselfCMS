<?php

use App\Article;
use App\Tag;
use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $json = File::get(public_path('data.json'));
        $data = json_decode($json);
        $articles = $data->articles;
    
        foreach ($articles as $item) {
            $article = Article::create([
                'title'       => $item->title,
                'slug'        => str_slug($item->title),
                'body'        => 'Cuerpo',
                'description' => $item->description,
                'image'       => $item->image,
                'status'      => Article::PUBLISHED,
                'user_id'     => 1,
                'category_id' => 1,
            ]);

            $tags = Tag::all()
        		->random(mt_rand(1,3))
        		->pluck('id');

        	$article->tags()->attach($tags);
        }
    }
}
