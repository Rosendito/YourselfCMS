<?php

/*
|--------------------------------------------------------------------------
| Blog Routes
|--------------------------------------------------------------------------
|
| Blog routes 
*/

Route::get('/', function () {
    return redirect()->route('login');
});
// Route::get('/{post}', 'Web\BlogController@post');
// Route::get('/categoria/{category}', 'Web\BlogController@category');
// Route::get('/etiqueta/{tag}', 'Web\BlogController@tag');

