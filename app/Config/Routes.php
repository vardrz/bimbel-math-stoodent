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
});