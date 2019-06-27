<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Article;

class PageController extends Controller
{
    public function home () 
    {
        $json = File::get(public_path('data.json'));
        $data = json_decode($json);

        $articles = Article::orderBy('created_at', 'desc')
            ->where('status', Article::PUBLISHED)
            ->take(3)
            ->get();

        return view('pages.home', [
            'articles' => $articles,
            'events' => $data->events
        ]);
    }
}
