<?php

$router->group([
	'namespace' => 'Tag\Action',
	'middleware' => 'auth'
], function($router) {
	$router->get('tag', 'TagAction@all');

	$router->get('tag/{id}', 'TagAction@find');

	$router->post('tag', 'TagAction@store');
	
	$router->delete('tag/{id}', 'TagAction@delete');
});