<?php

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

$router->get('/', function() {
	return "Not found! This is for REST API";
});


$router->group([
	'prefix' => 'api'
], function($router) {
	require __DIR__.'/../src/App/Auth/Routes/Api.php';
	require __DIR__.'/../src/App/Category/Routes/Api.php';
	require __DIR__.'/../src/App/Post/Routes/Api.php';
	require __DIR__.'/../src/App/Media/Routes/Api.php';
	require __DIR__.'/../src/App/Tag/Routes/Api.php';
});
