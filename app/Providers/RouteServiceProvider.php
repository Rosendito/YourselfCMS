<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Finder\Finder;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(function () {
                $this->requireRoutes('routes\web');
             });
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        // Route::prefix('adadada')
        //      ->middleware('api')
        //      ->namespace($this->namespace)
        //      ->group(function () {
        //         $this->requireRoutes('routes\api');
        //      });
    }

    /**
     * Recolecta los archivos de los directorios "api" y "web" de los routes
     *
     * @return void
     * 
     * @param $path ruta del directorio 
    */

    protected function requireRoutes($path)
    {
        return collect(
            Finder::create()
                ->in(base_path($path))
                ->name('*.php')
        )->each(function ($file) {
            require $file->getRealPath();
        });
    }
}
