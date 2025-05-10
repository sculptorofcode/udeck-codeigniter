<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Redirect root to dashboard if logged in, otherwise to login page
$routes->get('/', 'Home::index');

// Authentication routes
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::attemptLogin');
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::attemptRegister');
$routes->get('/logout', 'Auth::logout');

// Dashboard route
$routes->get('/dashboard', 'Dashboard::index');

// Task management routes
$routes->group('tasks', function($routes) {
    $routes->get('/', 'Tasks::index');
    $routes->get('create', 'Tasks::create');
    $routes->post('store', 'Tasks::store');
    $routes->get('edit/(:num)', 'Tasks::edit/$1');
    $routes->post('update/(:num)', 'Tasks::update/$1');
    $routes->get('delete/(:num)', 'Tasks::delete/$1');
});
