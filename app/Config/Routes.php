<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->get('/', 'Home::index');
$routes->get('identite', 'NosIdentite::index');
$routes->get('histoire', 'Histoire::index');
$routes->get('finance', 'Finance::index');
$routes->get('finance/financeByYear', 'Finance::financeByYear');
$routes->get('finance/financeByType', 'Finance::financeByType');
$routes->get('equipe', 'Equipe::index');
$routes->get('contact', 'Contact::index');
$routes->post('contact/save', 'Contact::save');
$routes->get('blog/detail/(:num)', 'Documentation::detail/$1');


$routes->get('solution', 'Resolution::index');
$routes->get('strategie', 'NosStrategie::index');
$routes->get('approche', 'Approche::index');
$routes->get('suivi', 'SuiviEvaluation::index');
$routes->get('impact', 'Impact::index');
$routes->get('part', 'Particularite::index');
$routes->get('documentation', 'Documentation::index');

$routes->get('backend', 'Login::index');
$routes->post('login', 'Login::do_login');

$routes->get('logout', 'Login::logout');
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



$routes->group('videos', ['namespace' => '\App\Modules\Features\Controllers'],static function ($routes) {
$routes->get('/', 'VideoForme::index');
$routes->post('liste', 'VideoForme::getList');
$routes->post('store', 'VideoForme::save');
$routes->get('getOne/(:num)', 'VideoForme::getOne/$1');
$routes->post('delete', 'VideoForme::delete');
});


$routes->group('administration', ['namespace' => '\App\Modules\Administration\Controllers'],static function ($routes) {

    $routes->get('user', 'User::index');

    $routes->match(['get', 'post'], 'user/liste', 'User::listing');

    $routes->get('user/ajouter', 'User::ajouter');
    $routes->post('user/add', 'User::add');

    $routes->get('user/index_update/(:num)', 'User::index_update/$1');
    $routes->post('user/update', 'User::update');

    $routes->get('user/desactiver/(:num)', 'User::desactiver/$1');
    $routes->get('user/reactiver/(:num)', 'User::reactiver/$1');
});


$routes->group('administration', ['namespace' => 'App\Modules\Administration\Controllers'], function ($routes) {

    // Profil & Droits
    $routes->get('profil-droit', 'ProfilDroit::index');
    $routes->post('profil-droit/listing', 'ProfilDroit::listing');

    $routes->get('profil-droit/ajouter', 'ProfilDroit::ajouter');
    $routes->post('profil-droit/add', 'ProfilDroit::add');

    $routes->get('profil-droit/update/(:num)', 'ProfilDroit::index_update/$1');
    $routes->post('profil-droit/update', 'ProfilDroit::update');

    $routes->get('profil-droit/suppression/(:num)', 'ProfilDroit::suppression/$1');
});
// ============================
// ABOUT MODULE ROUTES
// ============================

$routes->group('about', ['namespace' => 'App\Modules\Features\Controllers'], function ($routes) {

    // Page principale
    $routes->get('/', 'About::index');

    // DataTable liste (AJAX)
    $routes->post('liste', 'About::getList');

    // Save (INSERT + UPDATE)
    $routes->post('store', 'About::save');

    // Get one record
    $routes->get('getOne/(:num)', 'About::getOne/$1');

    // Delete
    $routes->post('delete', 'About::delete');
});

// =========================
// TEAM
// =========================

$routes->group('team', ['namespace' => 'App\Modules\Features\Controllers'], static function ($routes) {

    $routes->get('/', 'Team::index');

    // DataTable
    $routes->post('liste', 'Team::getList');

    // Insert / Update
    $routes->post('store', 'Team::save');

    // Récupérer un membre
    $routes->get('getOne/(:num)', 'Team::getOne/$1');

    // Suppression
    $routes->post('delete', 'Team::delete');
});


$routes->group('finances', ['namespace' => 'App\Modules\Features\Controllers'],static function ($routes) {

    // Vue principale
    $routes->get('/', 'Finance::index');

    // DataTable
    $routes->post('liste', 'Finance::getList');

    // Ajouter / Modifier
    $routes->post('store', 'Finance::save');

    // Récupérer une ligne
    $routes->get('getOne/(:num)', 'Finance::getOne/$1');

    // Supprimer
    $routes->post('delete', 'Finance::delete');
});


// OBJECTIFS
$routes->group('objectifs', ['namespace' => 'App\Modules\Strategie\Controllers'],static function ($routes) {

    $routes->get('/', 'Strategie::index');

    $routes->post('liste', 'Strategie::getList');

    $routes->post('store', 'Strategie::save');

    $routes->get('getOne/(:num)', 'Strategie::getOne/$1');

    $routes->post('delete', 'Strategie::delete');
});

$routes->group('activites', ['namespace' => 'App\Modules\Strategie\Controllers'],static function ($routes) {

    $routes->get('/', 'ApprocheBackend::index');

    $routes->post('liste', 'ApprocheBackend::getList');

    $routes->post('store', 'ApprocheBackend::save');

    $routes->get('getOne/(:num)', 'ApprocheBackend::getOne/$1');

    $routes->post('delete', 'ApprocheBackend::delete');
});


$routes->group('systeme-suivi', ['namespace' => 'App\Modules\Strategie\Controllers'],static function ($routes) {

    $routes->get('/', 'SystemeSuivi::index');

    $routes->post('liste', 'SystemeSuivi::getList');

    $routes->post('store', 'SystemeSuivi::save');

    $routes->get('getOne/(:num)', 'SystemeSuivi::getOne/$1');

    $routes->post('delete', 'SystemeSuivi::delete');
});



$routes->group('impacts', ['namespace' => 'App\Modules\Strategie\Controllers'],static function ($routes) {

    $routes->get('/', 'ImpactBackend::index');

    $routes->post('liste', 'ImpactBackend::getList');

    $routes->post('store', 'ImpactBackend::save');

    $routes->get('getOne/(:num)', 'ImpactBackend::getOne/$1');

    $routes->post('delete', 'ImpactBackend::delete');

    $routes->post('changeStatut', 'ImpactBackend::changeStatut');
});




$routes->group('particularites', ['namespace' => 'App\Modules\Strategie\Controllers'],static function ($routes) {

    $routes->get('/', 'Particularite::index');

    $routes->post('liste', 'Particularite::getList');

    $routes->post('store', 'Particularite::save');

    $routes->get('getOne/(:num)', 'Particularite::getOne/$1');

    $routes->post('delete', 'Particularite::delete');

    $routes->post('changeStatut', 'Particularite::changeStatut');
});