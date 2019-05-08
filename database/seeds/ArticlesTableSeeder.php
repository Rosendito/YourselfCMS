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
        factory(Article::class, 15)
        	->create()
        	->each(function ($post) {
        		$tags = Tag::all()
        			->random(mt_rand(1,3))
        			->pluck('id');

        		$post->tags()->attach($tags);
        	});
    }
}
