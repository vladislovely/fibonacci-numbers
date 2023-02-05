<?php

/** @var Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use App\Http\Controllers\Controller;
use Laravel\Lumen\Routing\Router;

$router->get('/', 'Controller@index');

$router->get('/fibonacci', 'Controller@calculate');
