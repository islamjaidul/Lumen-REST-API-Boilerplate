<?php

$router->group([
	'namespace' => 'Category\Action',
	'middleware' => 'auth'
], function($router) {
	$router->get('category', 'CategoryAction@all');

	$router->get('category/{id}', 'CategoryAction@find');

	$router->post('category', 'CategoryAction@store');
	
	$router->delete('category/{id}', 'CategoryAction@delete');
});