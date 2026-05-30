<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
// $routes->get('/', 'Home::index');
$routes->get('/', 'Login::index');

// $routes->get('/', 'Accueil_Backend::index');
$routes->get('accueil', 'AccueilBackend::index');
$routes->get('form1', 'FormExample::index');
$routes->get('liste', 'FormExample::Listing');

