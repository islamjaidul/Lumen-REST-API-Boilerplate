<?php

$router->group([
	'namespace' => 'Post\Action',
	'middleware' => 'auth'
], function($router) {
	$router->get('post', 'PostAction@all');

	$router->get('post/{id}', 'PostAction@find');

	$router->post('post', 'PostAction@store');
	
	$router->delete('post/{id}', 'PostAction@delete');
});