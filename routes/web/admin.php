<?php


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Routes for Admin views and logic
*/

function __multipleRoutes($routes, $controller)
{
	foreach($routes as $route) {
		Route::get($route, $controller);
	}
}

Route::middleware('auth')->prefix('/admin')->group(function () {
	__multipleRoutes([
		'/',
		'/escritorio',
		'/articulos',
		'/articulos/crear',
		'/articulos/{id}/detalles',
		'/articulos/{id}/editar',
		'/categorias',
		'/etiquetas',
		'/usuarios',
		'/examples/template',
	], 'Admin\AdminController@index');
});