<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
// $routes->get('/', 'Home::index');
$routes->get('/', 'Login::index');

// $routes->get('/', 'Accueil_Backend::index');
$routes->get('accueil', 'AccueilBackend::index');
$routes->get('form1', 'FormExample1::index');
$routes->get('liste', 'FormExample1::Listing');
// FormExample CRUD routes
$routes->get('formexample', 'FormExample::index');
$routes->get('formexample/create', 'FormExample::create');
$routes->post('formexample/store', 'FormExample::store');
$routes->get('formexample/edit/(:num)', 'FormExample::edit/$1');
$routes->post('formexample/update/(:num)', 'FormExample::update/$1');
$routes->get('formexample/delete/(:num)', 'FormExample::delete/$1');
$routes->get('formexample/getCommunes/(:num)', 'FormExample::getCommunes/$1');
$routes->get('formexample/getZones/(:num)', 'FormExample::getZones/$1');
$routes->get('formexample/getCollines/(:num)', 'FormExample::getCollines/$1');
$routes->get('formexample/export', 'FormExample::exportCsv');
$routes->get('blog', '\\App\Modules\Blog\Controllers\Blog::index');
$routes->get('blog/post/(:segment)', '\\App\Modules\Blog\Controllers\Blog::post/$1');
// Temporary: clear page cache
$routes->get('blog/clear-cache', '\\App\Modules\Blog\Controllers\Blog::clearCache');

