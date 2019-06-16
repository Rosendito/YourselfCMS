<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{
    public function home () 
    {
        $json = File::get(public_path('data.json'));
        $data = json_decode($json);

        return view('pages.home', [
            'articles' => $data->articles,
            'events' => $data->events
        ]);
    }
}
