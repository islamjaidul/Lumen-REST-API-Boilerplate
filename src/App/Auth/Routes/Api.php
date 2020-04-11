<?php

$router->group([
	'namespace' => 'Auth\Action'
], function($router) {
	$router->post('/register', 'AuthAction@register');
	
	$router->post('/login', 'AuthAction@login');
	$router->get('/logout', 'AuthAction@logout');

	$router->get('/user', [
	    'middleware' => 'auth',
	    'uses' => 'AuthAction@authUserInfo'
	]);

});