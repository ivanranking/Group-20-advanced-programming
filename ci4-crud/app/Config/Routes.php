<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');

$routes->get('services', 'Services::index');
$routes->get('services/(:any)', 'Services::$1');
$routes->get('participants', 'ParticipantController::index');
$routes->get('participants/(:any)', 'ParticipantController::$1');
$routes->get('programs', 'ProgramController::index');
$routes->get('programs/(:any)', 'ProgramController::$1');
$routes->get('equipment', 'EquipmentController::index');
$routes->get('equipment/(:any)', 'EquipmentController::$1');
$routes->get('projects', 'ProjectController::index');
$routes->get('projects/(:any)', 'ProjectController::$1');
