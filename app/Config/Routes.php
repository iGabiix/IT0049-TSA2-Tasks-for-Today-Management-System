<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->get('tasks', 'TaskController::index');
$routes->get('tasks/new', 'TaskController::createForm', ['filter' => 'auth']);
$routes->post('tasks', 'TaskController::create', ['filter' => 'auth']);
$routes->get('tasks/(:num)/edit', 'TaskController::edit/$1', ['filter' => 'auth']);
$routes->post('tasks/(:num)', 'TaskController::update/$1', ['filter' => 'auth']);
$routes->post('tasks/(:num)/delete', 'TaskController::delete/$1', ['filter' => 'auth']);
$routes->get('profile', 'ProfileController::index');
$routes->get('about', 'AboutController::index');
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::attemptLogin');
$routes->post('logout', 'AuthController::logout', ['filter' => 'auth']);
