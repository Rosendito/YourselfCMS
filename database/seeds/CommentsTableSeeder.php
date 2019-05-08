<?php

use App\Comment;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::create([
            'autor_name'  => 'Señor X',
            'autor_email' => 'x@inexistentes.com',
            'body'        => 'Este comentario no existe',
            'article_id'  => 1
         ]);
    }
}
