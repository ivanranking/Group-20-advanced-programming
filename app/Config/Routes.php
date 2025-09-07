<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');

$routes->resource('services');
$routes->resource('participants');
$routes->resource('programs');
$routes->resource('equipment');
$routes->resource('projects');
$routes->resource('outcomes');
$routes->resource('facilities');

// Additional routes for project participants
$routes->post('projects/(:num)/add-participant/(:num)', 'ProjectController::addParticipant/$1/$2');
$routes->post('projects/(:num)/remove-participant/(:num)', 'ProjectController::removeParticipant/$1/$2');

// Download route for outcomes
$routes->get('outcomes/download/(:num)', 'OutcomesController::download/$1');
