<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Auth
$routes->get('/', 'Auth::index');
$routes->post('/auth/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');

// dashboard
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'authGuard']);

// Products
$routes->get('/products', 'Products::index', ['filter' => 'authGuard']);
$routes->get('/products/create', 'Products::create', ['filter' => 'authGuard']);
$routes->post('/products/store', 'Products::store', ['filter' => 'authGuard']);
$routes->get('/products/edit/(:num)', 'Products::edit/$1', ['filter' => 'authGuard']);
$routes->post('/products/update/(:num)', 'Products::update/$1', ['filter' => 'authGuard']);
$routes->get('/products/deactivate/(:num)', 'Products::deactivate/$1', ['filter' => 'authGuard']);
$routes->get('/products/activate/(:num)', 'Products::activate/$1', ['filter' => 'authGuard']);

// Barang Masuk
$routes->get('/barang-masuk', 'ProductPurchaseController::index', ['filter' => 'authGuard']);
$routes->get('/barang-masuk/create', 'ProductPurchaseController::create', ['filter' => 'authGuard']);
$routes->post('/barang-masuk/store', 'ProductPurchaseController::store', ['filter' => 'authGuard']);
$routes->get('barang-masuk/delete/(:num)', 'ProductPurchaseController::delete/$1', ['filter' => 'authGuard']);

// Barang Keluar
$routes->get('/barang-keluar', 'ProductSaleController::index', ['filter' => 'authGuard']);
$routes->post('/barang-keluar/store', 'ProductSaleController::store', ['filter' => 'authGuard']);
$routes->get('/barang-keluar/delete/(:num)', 'ProductSaleController::delete/$1', ['filter' => 'authGuard']);

// Stock Opname
$routes->get('stockopname', 'StockOpname::index', ['filter' => 'authGuard']);
$routes->post('stockopname/process', 'StockOpname::process', ['filter' => 'authGuard']);

// Kartu Persediaan
$routes->get('kartu-persediaan', 'InventoryCardController::index', ['filter' => 'authGuard']);
$routes->post('kartu-persediaan/filter', 'InventoryCardController::filter', ['filter' => 'authGuard']);

// Laporan
$routes->group('laporan', function($routes) {
    $routes->get('umum', 'LaporanUmum::laporanUmum', ['filter' => 'authGuard']);
    $routes->get('barang-masuk', 'LaporanBarangMasuk::laporanBarangMasuk', ['filter' => 'authGuard']);
    $routes->get('barang-keluar', 'LaporanBarangKeluar::laporanBarangKeluar', ['filter' => 'authGuard']);
});
