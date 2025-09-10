<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');

$routes->resource('services', ['controller' => 'Services']);
$routes->get('participants', 'Participant::index');
$routes->get('participants/new', 'Participant::new');
$routes->post('participants/create', 'Participant::create');
$routes->get('participants/view/(:num)', 'Participant::show/$1');
$routes->get('participants/edit/(:num)', 'Participant::edit/$1');
$routes->post('participants/update/(:num)', 'Participant::update/$1');
$routes->get('participants/delete/(:num)', 'Participant::delete/$1');
$routes->resource('programs', ['controller' => 'ProgramController']);
$routes->resource('equipment', ['controller' => 'EquipmentController']);
$routes->resource('projects', ['controller' => 'ProjectController']);
$routes->resource('outcomes', ['controller' => 'OutcomesController']);
$routes->resource('facilities', ['controller' => 'FacilityController']);
$routes->resource('facilities/store', ['controller' => 'FacilityController']);

// Additional routes for project participants
$routes->post('projects/(:num)/add-participant/(:num)', 'ProjectController::addParticipant/$1/$2');
$routes->post('projects/(:num)/remove-participant/(:num)', 'ProjectController::removeParticipant/$1/$2');

// Download route for outcomes
$routes->get('outcomes/download/(:num)', 'OutcomesController::download/$1');
