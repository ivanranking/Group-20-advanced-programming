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
$routes->get('equipment/delete', function() {
    return redirect()->to('/equipment')->with('error', 'Invalid delete request.');
});
$routes->get('equipment/delete/(:num)', 'EquipmentController::delete/$1');
$routes->resource('equipment', ['controller' => 'EquipmentController']);
$routes->post('equipment/update/(:num)', 'EquipmentController::update/$1');
$routes->resource('projects', ['controller' => 'ProjectController']);
$routes->resource('outcomes', ['controller' => 'OutcomesController']);
$routes->get('facilities', 'FacilityController::index');
$routes->get('facilities/new', 'FacilityController::new');
$routes->post('facilities/create', 'FacilityController::create');
$routes->get('facilities/edit/(:num)', 'FacilityController::edit/$1');
$routes->post('facilities/update/(:num)', 'FacilityController::update/$1');
$routes->get('facilities/delete/(:num)', 'FacilityController::delete/$1');
$routes->get('facilities/(:num)', 'FacilityController::show/$1');

// Additional routes for project participants
$routes->post('projects/(:num)/add-participant/(:num)', 'ProjectController::addParticipant/$1/$2');
$routes->post('projects/(:num)/remove-participant/(:num)', 'ProjectController::removeParticipant/$1/$2');

// Download route for outcomes
$routes->get('outcomes/download/(:num)', 'OutcomesController::download/$1');

// Settings routes
 $routes->get('settings', 'SettingsController::index');
 $routes->post('settings/update-theme', 'SettingsController::updateTheme');
 $routes->post('settings/update-language', 'SettingsController::updateLanguage');
 $routes->post('settings/update-settings', 'SettingsController::updateSettings');
 $routes->post('settings/reset', 'SettingsController::resetSettings');
 $routes->get('settings/export', 'SettingsController::exportSettings');
 $routes->get('settings/current', 'SettingsController::getCurrentSettings');

// Test route
 $routes->get('test', function() {
     return view('test');
 });

// Notification routes
 $routes->get('notifications/recent', 'NotificationController::getRecentActivities');
 $routes->get('notifications/count', 'NotificationController::getNotificationCount');
 $routes->get('notifications/stats', 'NotificationController::getActivityStats');
 $routes->post('notifications/mark-read', 'NotificationController::markAsRead');
