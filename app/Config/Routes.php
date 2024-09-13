<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'LoginController::index', ['filter' => 'login']);
$routes->post('/login', 'LoginController::login');
$routes->get('/logout', 'LoginController::logout');

$routes->group('/', ['filter' => 'logout'], function ($routes) {
    $routes->get('/home', 'HomeController::index');
    // Siswa
    $routes->get('/siswa', 'SiswaController::index');
    $routes->get('/siswa/add', 'SiswaController::add');
    $routes->post('/siswa/add', 'SiswaController::save');
    $routes->get('/siswa/edit/(:any)', 'SiswaController::edit/$1');
    $routes->post('/siswa/update', 'SiswaController::update');
    $routes->get('/siswa/delete/(:any)', 'SiswaController::delete/$1');
    // Tagihan
    $routes->get('/tagihan', 'TagihanController::index');
    $routes->get('/tagihan/add', 'TagihanController::add');
    $routes->post('/tagihan/add', 'TagihanController::save');
    $routes->get('/tagihan/edit/(:any)', 'TagihanController::edit/$1');
    $routes->post('/tagihan/update', 'TagihanController::update');
    $routes->get('/tagihan/delete/(:any)', 'TagihanController::delete/$1');
    // Tagihan
    $routes->get('/pembayaran', 'PembayaranController::index');
    $routes->get('/pembayaran/accept/(:any)/(:any)', 'PembayaranController::accept/$1/$2');
    $routes->get('/pembayaran/reject/(:any)', 'PembayaranController::reject/$1');
    // Email
    $routes->post('/tagihan/email/batch', 'TagihanController::emailBatch');
    $routes->post('/tagihan/email/send', 'TagihanController::email');



    // Wali
    $routes->get('/wali/home', 'WaliController::index');
    $routes->get('/wali/bayar/(:any)', 'WaliController::bayar/$1');
    $routes->post('/wali/bayar', 'WaliController::upload');
});