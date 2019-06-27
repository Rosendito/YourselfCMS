<?php

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
| Routes for Authentication views and logic
*/

Route::get('cms/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('cms/login', 'Auth\LoginController@login');
Route::get('cms/logout', 'Auth\LoginController@logout')->name('logout');
