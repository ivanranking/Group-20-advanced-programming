<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');

$routes->resource('services', ['controller' => 'Services']);
$routes->resource('participants', ['controller' => 'ParticipantController']);
$routes->resource('programs', ['controller' => 'ProgramController']);
$routes->resource('equipment', ['controller' => 'EquipmentController']);
$routes->resource('projects', ['controller' => 'ProjectController']);
$routes->resource('outcomes', ['controller' => 'OutcomesController']);
$routes->resource('facilities', ['controller' => 'FacilityController']);

// Additional routes for project participants
$routes->post('projects/(:num)/add-participant/(:num)', 'ProjectController::addParticipant/$1/$2');
$routes->post('projects/(:num)/remove-participant/(:num)', 'ProjectController::removeParticipant/$1/$2');

// Download route for outcomes
$routes->get('outcomes/download/(:num)', 'OutcomesController::download/$1');
