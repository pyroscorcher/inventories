<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');
$routes->post('/auth/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');

// Protected page
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'authGuard']);

// Product routes
$routes->get('/products', 'Products::index');
$routes->get('/products/create', 'Products::create');
$routes->post('/products/store', 'Products::store');
$routes->get('/products/edit/(:num)', 'Products::edit/$1');
$routes->post('/products/update/(:num)', 'Products::update/$1');
$routes->get('/products/deactivate/(:num)', 'Products::deactivate/$1');
$routes->get('/products/activate/(:num)', 'Products::activate/$1');

