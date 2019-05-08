<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Category;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function index (Request $request)
    {
        $users        = User::all();
        $categories   = Category::all();
        $tags         = Tag::all();
        $articles     = Article::all();
        $articlesTags = DB::table('article_tag')->get();
        $comments     = Comment::all();
        $logged       = $request->user();

    	$data = [
            'users'        => $users,
            'categories'   => $categories,
            'tags'         => $tags,
    		'articles'     => $articles,
            'articlesTags' => $articlesTags,
            'comments'     => $comments,
            'logged'       => $logged,
    	];

    	return view('layouts.admin', [
            'data' => $data,
        ]);
    }
}
