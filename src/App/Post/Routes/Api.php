<?php

$router->group([
	'namespace' => 'Post\Action',
	'middleware' => 'auth'
], function($router) {
	$router->get('posts', 'PostAction@all');

	$router->get('posts/{id}', 'PostAction@find');

	$router->post('posts', 'PostAction@store');
	
	$router->delete('posts/{id}', 'PostAction@delete');
});