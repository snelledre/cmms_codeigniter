<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'group:admin,superadmin'], static function ($routes) {
    $routes->group('locations', static function ($routes) {
        $routes->get('new', 'LocationsController::new', ['as' => 'locations_new']);
        $routes->post('', 'LocationsController::create', ['as' => 'locations_create']);
        $routes->get('', 'LocationsController::index', ['as' => 'locations']);
        $routes->get('(:num)', 'LocationsController::show/$1', ['as' => 'locations_show']);
        $routes->get('(:num)/edit', 'LocationsController::edit/$1', ['as' => 'locations_edit']);
        $routes->post('(:num)/update', 'LocationsController::update/$1', ['as' => 'locations_update']);
        $routes->post('delete/(:num)', 'LocationsController::delete/$1', ['as' => 'locations_delete']);
        $routes->get('(:num)/htmlToPDF', 'LocationsController::htmlToPDF/$1', ['as' => 'locations_htmlToPDF']);
    });

    $routes->group('machines', static function ($routes) {
        $routes->get('new', 'MachinesController::new', ['as' => 'machines_new']);
        $routes->post('', 'MachinesController::create', ['as' => 'machines_create']);
        $routes->get('', 'MachinesController::index', ['as' => 'machines']);
        $routes->get('(:num)', 'MachinesController::show/$1', ['as' => 'machines_show']);
        $routes->get('(:num)/edit', 'MachinesController::edit/$1', ['as' => 'machines_edit']);
        $routes->post('(:num)/update', 'MachinesController::update/$1', ['as' => 'machines_update']);
        $routes->post('delete/(:num)', 'MachinesController::delete/$1', ['as' => 'machines_delete']);
        $routes->get('(:num)/htmlToPDF', 'MachinesController::htmlToPDF/$1', ['as' => 'machines_htmlToPDF']);
    });

    // $routes->group('lubricants', static function ($routes) {
    //     $routes->get('new', 'LubricantsController::new', ['as' => 'lubricants_new']);
    //     $routes->post('', 'LubricantsController::create', ['as' => 'lubricants_create']);
    //     $routes->get('', 'LubricantsController::index', ['as' => 'lubricants']);
    //     $routes->get('(:num)', 'LubricantsController::show/$1', ['as' => 'lubricants_show']);
    //     $routes->get('(:num)/edit', 'LubricantsController::edit/$1', ['as' => 'lubricants_edit']);
    //     $routes->post('(:num)/update', 'LubricantsController::update/$1', ['as' => 'lubricants_update']);
    //     $routes->post('delete/(:num)', 'LubricantsController::delete/$1', ['as' => 'lubricants_delete']);
    //     $routes->get('(:num)/htmlToPDF', 'LubricantsController::htmlToPDF/$1', ['as' => 'lubricants_htmlToPDF']);
    // });

    // $routes->group('jobtypes', static function ($routes) {
    //     $routes->get('new', 'JobtypesController::new', ['as' => 'jobtypes_new']);
    //     $routes->post('', 'JobtypesController::create', ['as' => 'jobtypes_create']);
    //     $routes->get('', 'JobtypesController::index', ['as' => 'jobtypes']);
    //     $routes->get('(:num)', 'JobtypesController::show/$1', ['as' => 'jobtypes_show']);
    //     $routes->get('(:num)/edit', 'JobtypesController::edit/$1', ['as' => 'jobtypes_edit']);
    //     $routes->post('(:num)/update', 'JobtypesController::update/$1', ['as' => 'jobtypes_update']);
    //     $routes->post('delete/(:num)', 'JobtypesController::delete/$1', ['as' => 'jobtypes_delete']);
    //     $routes->get('(:num)/htmlToPDF', 'JobtypesController::htmlToPDF/$1', ['as' => 'jobtypes_htmlToPDF']);
    // });

    // $routes->group('costcenters', static function ($routes) {
    //     $routes->get('new', 'CostcentersController::new', ['as' => 'costcenters_new']);
    //     $routes->post('', 'CostcentersController::create', ['as' => 'costcenters_create']);
    //     $routes->get('', 'CostcentersController::index', ['as' => 'costcenters']);
    //     $routes->get('(:num)', 'CostcentersController::show/$1', ['as' => 'costcenters_show']);
    //     $routes->get('(:num)/edit', 'CostcentersController::edit/$1', ['as' => 'costcenters_edit']);
    //     $routes->post('(:num)/update', 'CostcentersController::update/$1', ['as' => 'costcenters_update']);
    //     $routes->post('delete/(:num)', 'CostcentersController::delete/$1', ['as' => 'costcenters_delete']);
    //     $routes->get('(:num)/htmlToPDF', 'CostcentersController::htmlToPDF/$1', ['as' => 'costcenters_htmlToPDF']);
    // });

});

service('auth')->routes($routes);
