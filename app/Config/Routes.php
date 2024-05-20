<?php

use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'c_home::index');
$routes->get('/detail/(:any)', 'c_home::detail/$1');
$routes->post('cart/addToCart/(:segment)', 'CartController::addToCart/$1');
$routes->get('/cart', 'CartController::lookCart');
$routes->get('cart/remove/(:segment)', 'CartController::removeFromCart/$1');
$routes->get('cart/checkout', 'CartController::checkout');
