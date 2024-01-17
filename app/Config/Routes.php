<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/dashboard','Dashboard::index');
$routes->presenter('pendataan');
$routes->post('/pendataan/searchTabel', 'Pendataan::searchTabel');

service('auth')->routes($routes);
