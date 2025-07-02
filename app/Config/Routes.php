<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('HomeController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false); // Disarankan untuk keamanan

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// === BAGIAN 1: RUTE PUBLIK ===
$routes->get('/', 'HomeController::index');
$routes->get('menu', 'MenuController::index');
$routes->get('lokasi', 'LokasiController::index');
$routes->get('kontak', 'ContactController::index');
$routes->post('kontak', 'ContactController::submit');
$routes->post('order/create', 'OrderController::create');

// === BAGIAN 2: RUTE AUTENTIKASI ===
$routes->get('login', 'AuthController::index');
$routes->post('login/process', 'AuthController::processLogin');
$routes->get('logout', 'AuthController::logout');
$routes->get('register', 'AuthController::showRegisterForm');
$routes->post('register/process', 'AuthController::processRegister');


// === BAGIAN 3: RUTE ADMIN ===
$routes->group('admin', ['filter' => 'authGuard'], function ($routes) {
    
    // Rute default jika hanya mengakses /admin -> arahkan ke Dashboard
    // BENAR untuk struktur Anda
    $routes->get('/', 'DashboardController::index');    
    // Rute untuk Kelola Menu
    $routes->get('menu', 'AdminMenuController::index');
    $routes->get('menu/new', 'AdminMenuController::new');
    $routes->post('menu', 'AdminMenuController::create');
    $routes->get('menu/edit/(:num)', 'AdminMenuController::edit/$1');
    $routes->post('menu/update/(:num)', 'AdminMenuController::update/$1');
    $routes->get('menu/delete/(:num)', 'AdminMenuController::delete/$1');
    
    // Rute untuk Kelola Pesanan
    $routes->get('orders', 'OrderController::manage');
    $routes->get('orders/history', 'OrderController::history');
    $routes->get('orders/update/(:num)/(:any)', 'OrderController::updateStatus/$1/$2');
    $routes->get('dashboard/download', 'DashboardController::downloadReport');

});

// Rute untuk Profil Pengguna (membutuhkan login)
$routes->get('profile', 'UserController::profile', ['filter' => 'authGuardUser']);



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}