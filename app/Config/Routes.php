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
});