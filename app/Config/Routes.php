<?php

use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'c_home::index');
$routes->get('/detail/(:any)', 'c_home::detail/$1');
$routes->post('/add-to-cart', 'CartController::addToCart');
$routes->get('/cart', 'CartController::viewCart');
