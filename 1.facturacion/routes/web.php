<?php
use Illuminate\Http\Request;

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

$router->get('facturacion/{ref}', 'API\CalculoController@get_facturacion');
$router->post('facturacion/{ref}', 'API\CalculoController@post_facturacion');
$router->delete('facturacion/{ref}', 'API\CalculoController@delete_facturacion');


$router->get('/', function () use ($router) {
    return $router->app->version();
});
