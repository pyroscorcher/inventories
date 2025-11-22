<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Auth
$routes->get('/', 'Auth::index');
$routes->post('/auth/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');

// Protected dashboard
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'authGuard']);

// Products
$routes->get('/products', 'Products::index');
$routes->get('/products/create', 'Products::create');
$routes->post('/products/store', 'Products::store');
$routes->get('/products/edit/(:num)', 'Products::edit/$1');
$routes->post('/products/update/(:num)', 'Products::update/$1');
$routes->get('/products/deactivate/(:num)', 'Products::deactivate/$1');
$routes->get('/products/activate/(:num)', 'Products::activate/$1');

// Barang Masuk
$routes->get('/barang-masuk', 'ProductPurchaseController::index');
$routes->get('/barang-masuk/create', 'ProductPurchaseController::create');
$routes->post('/barang-masuk/store', 'ProductPurchaseController::store');
$routes->get('barang-masuk/delete/(:num)', 'ProductPurchaseController::delete/$1');

// Barang Keluar
$routes->get('/barang-keluar', 'ProductSaleController::index');
$routes->post('/barang-keluar/store', 'ProductSaleController::store');
$routes->get('/barang-keluar/delete/(:num)', 'ProductSaleController::delete/$1');