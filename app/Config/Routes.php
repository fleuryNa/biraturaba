<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->get('/', 'Home::index');
$routes->get('identite', 'NosIdentite::index');
$routes->get('histoire', 'Histoire::index');
$routes->get('finance', 'Finance::index');
$routes->get('equipe', 'Equipe::index');
$routes->get('contact', 'Contact::index');


$routes->get('solution', 'Resolution::index');
$routes->get('strategie', 'NosStrategie::index');
$routes->get('approche', 'Approche::index');
$routes->get('suivi', 'SuiviEvaluation::index');
$routes->get('impact', 'Impact::index');
$routes->get('part', 'Particularite::index');
$routes->get('documentation', 'Documentation::index');

$routes->get('backend', 'Login::index');
$routes->post('login', 'Login::doLogin');
$routes->get('logout', 'Login::doLogout');
$routes->get('checkSession', 'Login::checkSession');
$routes->get('createPassword/(:any)', 'Login::indexCP/$1');
$routes->post('savenewpassword', 'Login::createPassWord'); 
 
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




// Route principale (comme votre 'blog')
$routes->get('cartographie', '\\App\\Modules\\Cartographie\\Controllers\\Cartographie::index');

// Routes supplémentaires
$routes->get('cartographie/zones', '\\App\\Modules\\Cartographie\\Controllers\\Cartographie::zones');
$routes->get('cartographie/map', '\\App\\Modules\\Cartographie\\Controllers\\Cartographie::map');
$routes->get('cartographie/api/zones', '\\App\\Modules\\Cartographie\\Controllers\\Cartographie::apiGetZones');
$routes->get('cartographie/export/geojson', '\\App\\Modules\\Cartographie\\Controllers\\Cartographie::exportGeoJson');

////Carto Front

$routes->get('cartograph', '\\App\\Modules\\Cartographie\\Controllers\\Carto::index');

// Routes supplémentaires
$routes->get('cartograph/zones', '\\App\\Modules\\Cartographie\\Controllers\\Carto::zones');
$routes->get('cartograph/map', '\\App\\Modules\\Cartographie\\Controllers\\Carto::map');
$routes->get('cartograph/api/zones', '\\App\\Modules\\Cartographie\\Controllers\\Carto::apiGetZones');
$routes->get('cartograph/export/geojson', '\\App\\Modules\\Cartograph\\Controllers\\Carto::exportGeoJson');



//projets
$routes->group('projet', ['namespace' => '\App\Modules\Features\Controllers'], static function ($routes) {
    $routes->get('/', 'Projet::index');
    $routes->post('liste', 'Projet::getList');
    $routes->post('ajouter', 'Projet::getList');
    $routes->post('store', 'Projet::save');
    $routes->post('edit', 'Projet::edit');
    $routes->post('delete', 'Projet::delete');
    $routes->get('getOne/(:num)', 'Projet::getProjet/$1');
});


// ======================================================
// Partenaire
// ======================================================

$routes->group('partenaire', ['namespace' => '\App\Modules\Features\Controllers'], static function ($routes) {

    // Page principale
    $routes->get('/', 'Partenaire::index');

    // DataTable
    $routes->post('liste', 'Partenaire::getList');

    // Ajout / Modification
    $routes->post('store', 'Partenaire::save');

    // Récupérer un partenaire
    $routes->get('getOne/(:num)', 'Partenaire::getOne/$1');

    // Suppression
    $routes->post('delete', 'Partenaire::delete');
});


// =========================
// FEATURES MODULE
// =========================
$routes->group('features', ['namespace' => '\App\Modules\Features\Controllers'], static function ($routes) {
    $routes->get('/', 'Features::index');
    $routes->post('liste', 'Features::getList');
    $routes->post('store', 'Features::save');
    $routes->get('getOne/(:num)', 'Features::getFeature/$1');
    $routes->post('delete', 'Features::delete');
});


$routes->group('services', ['namespace' => '\App\Modules\Features\Controllers'],static function($routes) {

    // PAGE LISTE
    $routes->get('/', 'Service::index');

    // DATATABLE LISTE
    $routes->post('liste', 'Service::getList');

    // CREATE + UPDATE (même endpoint)
    $routes->post('store', 'Service::save');

    // GET ONE (EDIT)
    $routes->get('getOne/(:num)', 'Service::getOne/$1');

    // DELETE
    $routes->post('delete', 'Service::delete');
});

$routes->group('testimonials', ['namespace' => '\App\Modules\Features\Controllers'],static function($routes) {

    // PAGE LISTE
    $routes->get('/', 'Temoignage::index');

    // DATATABLE LISTE
    $routes->post('liste', 'Temoignage::getList');

    // CREATE + UPDATE (même endpoint)
    $routes->post('store', 'Temoignage::save');

    // GET ONE (EDIT)
    $routes->get('getOne/(:num)', 'Temoignage::getOne/$1');

    // DELETE
    $routes->post('delete', 'Temoignage::delete');
});


$routes->group('contacts', ['namespace' => '\App\Modules\Features\Controllers'],static function ($routes) {
    $routes->get('/', 'Contacts::index');
    $routes->post('liste', 'Contacts::getList');
    $routes->get('getOne/(:num)', 'Contacts::getOne/$1');
    $routes->post('delete', 'Contacts::delete');
    $routes->post('mark-read', 'Contacts::markAsRead');
});

$routes->group('blogs', ['namespace' => '\App\Modules\Features\Controllers'],static function ($routes) {
$routes->get('/', 'Blogs::index');
$routes->post('liste', 'Blogs::getList');
$routes->post('store', 'Blogs::save');
$routes->get('getOne/(:num)', 'Blogs::getOne/$1');
$routes->post('delete', 'Blogs::delete');
});