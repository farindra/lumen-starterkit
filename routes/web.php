<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

/* v1 group */
$router->group(['prefix' => 'v1'], function () use ($router) {

    renderRoutes('v1', $router);
    
});

/* lumen version */
$router->get('/version', function () use ($router) {
    return $router->app->version();
});

/**
 * render Routes files
 *
 * @param  string $folder folder under routes/*
 * @param  object $router
 * @return void
 */
function renderRoutes($folder, $router){

    foreach (glob( app()->basePath() . "/routes/{$folder}/*.php") as $filename)
    {
        include $filename;
    }
}