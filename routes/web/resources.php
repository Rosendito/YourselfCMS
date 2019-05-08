<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('api')->group(function () {
	// Articles
	Route::resource('articles', 'Admin\Resources\ArticleController',
		['except' => ['create', 'edit', 'show']]
	);

	// Categories
	Route::resource('categories', 'Admin\Resources\CategoryController',
		['except' => ['create', 'edit', 'show']]
	);

	// Tags
	Route::resource('tags', 'Admin\Resources\TagController',
		['except' => ['create', 'edit', 'show']]
	);

	// Users
	Route::resource('users', 'Admin\Resources\UserController',
		['except' => ['create', 'edit', 'show']]
	);
});
