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

$router->get('sumar', 'API\CalculoController@sumar');
$router->get('restar', 'API\CalculoController@restar');
$router->get('multiplicar', 'API\CalculoController@multiplicar');
$router->get('dividir', 'API\CalculoController@dividir');

$router->get('/', function () use ($router) {
    return $router->app->version();
});
